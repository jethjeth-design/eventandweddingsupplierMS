<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\ConversationParticipant;

class MessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INBOX
    |--------------------------------------------------------------------------
    */
    public function inbox()
    {
        $user = auth()->user();

        $conversations = Conversation::whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['participants.user', 'messages'])
            ->latest()
            ->get();

        $suppliers = User::whereHas('supplier')->get();

        $clients = User::where('role', 'client')->get();
        
        // ✅ ADD THIS
        $admins = User::where('role', 'admin')->get();

        return view('messages.inbox', compact(
            'conversations',
            'suppliers',
            'clients',
            'admins'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | OPEN CHAT (PRIVATE CHAT ONLY)
    |--------------------------------------------------------------------------
    */
    public function open(User $user)
    {
        $authUser = auth()->user();

        $conversation = Conversation::whereIn('type', [
                'client_supplier',
                'supplier_collaboration'
            ])
            ->whereHas('participants', function ($q) use ($authUser) {
                $q->where('user_id', $authUser->id);
            })
            ->whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->withCount('participants')
            ->having('participants_count', 2)
            ->first();

        if (!$conversation) {

            $conversation = Conversation::create([
                'created_by' => $authUser->id,
                'type' => (
                    $authUser->supplierProfile && $user->supplierProfile
                ) ? 'supplier_collaboration' : 'client_supplier',
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $authUser->id,
                'role' => $authUser->supplierProfile ? 'supplier' : 'client'
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $user->id,
                'role' => $user->supplierProfile ? 'supplier' : 'client'
            ]);
        }

        return redirect()->route('messages.chat', $conversation->id);
    }

    /*
    |--------------------------------------------------------------------------
    | CHAT ROOM
    |--------------------------------------------------------------------------
    */
    public function chat(Conversation $conversation)
    {
        $conversation->load([
            'messages.sender',
            'participants.user'
        ]);

        return view('messages.chat', compact('conversation'));
    }

    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE (FIXED SAFE VERSION)
    |--------------------------------------------------------------------------
    */
    public function send(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required'
        ]);

        $conversation = Conversation::find($request->conversation_id);

        if (!$conversation) {
            return back()->with('error', 'Conversation not found');
        }

        // safety: user must be participant
        $isMember = $conversation->participants()
            ->where('user_id', auth()->id())
            ->exists();

        if (!$isMember) {
            return back()->with('error', 'Unauthorized');
        }

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'message' => $request->message
        ]);

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | MANUAL GROUP CHAT CREATION (FIXED & CLEAN)
    |--------------------------------------------------------------------------
    */
    public function storeGroupChat(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'participants' => 'nullable|array',
            'client_id' => 'nullable|exists:users,id'
        ]);

        $authUser = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | CREATE GROUP CONVERSATION
        |--------------------------------------------------------------------------
        */
        $conversation = Conversation::create([
            'type' => 'group',
            'title' => $request->title,
            'created_by' => $authUser->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | ADD CREATOR (SUPPLIER OWNER OR ADMIN)
        |--------------------------------------------------------------------------
        */
        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $authUser->id,
            'role' => $authUser->role ?? 'supplier'
        ]);

        /*
        |--------------------------------------------------------------------------
        | ADD CLIENT (OPTIONAL)
        |--------------------------------------------------------------------------
        */
        if ($request->client_id) {
            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $request->client_id,
                'role' => 'client'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ADD SUPPLIERS / COLLABORATORS
        |--------------------------------------------------------------------------
        */
        foreach ($request->participants ?? [] as $userId) {

            if ($userId == $authUser->id) continue;

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $userId,
                'role' => 'supplier'
            ]);
        }

        return redirect()
            ->route('messages.chat', $conversation->id)
            ->with('success', 'Group chat created successfully.');
    }
}
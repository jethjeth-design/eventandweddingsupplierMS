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
public function inbox(Request $request)
{
    $user = auth()->user();

    $conversations = Conversation::whereHas('participants', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })
    ->with(['participants.user', 'messages.sender'])
    ->latest()
    ->get();

    $suppliers = User::whereHas('supplier')->get();
    $clients = User::where('role', 'client')->get();
    $admins = User::where('role', 'admin')->get();

    $conversation = null;

    if ($request->conversation_id) {
        $conversation = Conversation::with([
            'messages.sender',
            'participants.user'
        ])->find($request->conversation_id);

    /*
        |--------------------------------------------------------------------------
        | MARK MESSAGES AS READ
        |--------------------------------------------------------------------------
        */

        if ($conversation) {

            Message::where('conversation_id', $conversation->id)
                ->where('sender_id', '!=', auth()->id())
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);
        }
    }

    return view('messages.inbox', compact(
        'conversations',
        'suppliers',
        'clients',
        'admins',
        'conversation'
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

    $conversation = Conversation::whereHas('participants', function ($q) use ($authUser) {
            $q->where('user_id', $authUser->id);
        })
        ->whereHas('participants', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->first();

    if (!$conversation) {

        $conversation = Conversation::create([
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

    // 🔥 IMPORTANT: stay in same page
    return redirect()->route('messages.inbox', [
        'conversation_id' => $conversation->id
    ]);
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

        /*
    |--------------------------------------------------------------------------
    | MARK AS READ
    |--------------------------------------------------------------------------
    */

    Message::where('conversation_id', $conversation->id)
        ->where('sender_id', '!=', auth()->id())
        ->where('is_read', false)
        ->update([
            'is_read' => true,
            'read_at' => now()
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
            'message' => 'required',
            'file' => 'nullable|image|max:2048'
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

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat-files', 'public');
        }


        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
            'file' => $filePath
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

    public function startChat(User $user)
{
    $authUser = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | FIND PRIVATE CONVERSATION ONLY
    |--------------------------------------------------------------------------
    */

    $conversation = Conversation::whereIn('type', [
            'client_supplier',
            'supplier_collaboration',
            'admin_supplier',
            'client_admin'
        ])

        ->whereHas('participants', function ($q) use ($authUser) {
            $q->where('user_id', $authUser->id);
        })

        ->whereHas('participants', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })

        // ✅ IMPORTANT
        ->withCount('participants')

        // ✅ ONLY PRIVATE CHAT
        ->having('participants_count', 2)

        ->first();

    /*
    |--------------------------------------------------------------------------
    | CREATE PRIVATE CHAT
    |--------------------------------------------------------------------------
    */

    if (!$conversation) {

        /*
        |--------------------------------------------------------------------------
        | DETERMINE CHAT TYPE
        |--------------------------------------------------------------------------
        */

        $type = 'client_supplier';

        // admin ↔ supplier/client
        if (
            $authUser->role === 'admin' ||
            $user->role === 'admin'
        ) {
            $type = 'admin_supplier';
        }

        // supplier ↔ supplier
        if (
            $authUser->supplierProfile &&
            $user->supplierProfile
        ) {
            $type = 'supplier_collaboration';
        }

        // client ↔ admin
        if (
            $authUser->role === 'client' &&
            $user->role === 'admin'
        ) {
            $type = 'client_admin';
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE CONVERSATION
        |--------------------------------------------------------------------------
        */

        $conversation = Conversation::create([
            'type' => $type,
            'title' => null,
            'created_by' => $authUser->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | AUTH USER
        |--------------------------------------------------------------------------
        */

        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $authUser->id,
            'role' => $authUser->role
        ]);

        /*
        |--------------------------------------------------------------------------
        | OTHER USER
        |--------------------------------------------------------------------------
        */

        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $user->id,
            'role' => $user->role
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | OPEN CHAT IN SAME PAGE
    |--------------------------------------------------------------------------
    */

    return redirect()->route('messages.inbox', [
        'conversation_id' => $conversation->id
    ]);
}
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
public function inbox(Request $request)
{
    $user = auth()->user();

    $conversations = Conversation::whereHas('participants', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })
    ->with(['participants.user', 'messages.sender'])
    ->latest()
    ->get();

    $conversation = null;

    if ($request->conversation_id) {
        $conversation = Conversation::with([
            'messages.sender',
            'participants.user'
        ])->find($request->conversation_id);
    }

    return view('messages.inbox', compact(
        'conversations',
        'conversation'
    ));
}

public function chat(Conversation $conversation)
{
    $conversation->load(['messages.sender', 'participants.user']);

    return view('messages.chat', compact('conversation'));
}

public function send(Request $request)
{
    $request->validate([
        'conversation_id' => 'required|exists:conversations,id',
        'message' => 'required'
    ]);

    $conversation = Conversation::findOrFail($request->conversation_id);

    // ensure admin is participant
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

public function startChat(User $user)
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

        $type = 'client_supplier';

        if ($authUser->role === 'admin' || $user->role === 'admin') {
            $type = 'admin_supplier';
        }

        $conversation = Conversation::create([
            'type' => $type,
            'title' => null
        ]);

        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $authUser->id,
            'role' => $authUser->role
        ]);

        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $user->id,
            'role' => $user->role
        ]);
    }

    return redirect()->route('messages.inbox', [
        'conversation_id' => $conversation->id
    ]);
}
}

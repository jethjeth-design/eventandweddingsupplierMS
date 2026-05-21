<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function inbox()
{
    $conversations = Conversation::whereHas('participants', function ($q) {
        $q->where('user_id', auth()->id());
    })
    ->with(['messages', 'participants.user'])
    ->latest()
    ->get();

    return view('messages.inbox', compact('conversations'));
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
}

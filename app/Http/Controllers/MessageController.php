<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
     public function inbox()
    {
        $conversations = Message::where('receiver_id', auth()->id())
        ->orWhere('sender_id', auth()->id())
        ->with('sender', 'receiver')
        ->latest()
        ->get()
        ->unique(function ($msg) {
            return $msg->sender_id == auth()->id()
                ? $msg->receiver_id
                : $msg->sender_id;
        });

    return view('client.inbox.list', compact('conversations'));
    }
    // ✅ Open Chat (Client or Supplier)
    public function chat($userId, $supplierId)
    {   
        
        $messages = Message::where(function ($q) use ($userId, $supplierId) {
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $userId)
              ->where('supplier_id', $supplierId);
        })
        ->orWhere(function ($q) use ($userId, $supplierId) {
            $q->where('sender_id', $userId)
              ->where('receiver_id', auth()->id())
              ->where('supplier_id', $supplierId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        // ✅ mark messages as read
        Message::where('receiver_id', auth()->id())
            ->where('sender_id', $userId)
            ->where('supplier_id', $supplierId)
            ->update(['is_read' => true]);

        return view('messages.chatbox', compact('messages', 'userId', 'supplierId'));
    }

    // ✅ Send Message (Client or Supplier)
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'supplier_id' => 'required|exists:supplier_profiles,id',
            'message' => 'required|string'
        ]);

        $user = auth()->user();

        // Get receiver
        $receiver = User::findOrFail($request->receiver_id);

        // ✅ Only allow:
        // Client → Supplier
        // Supplier → Client
        
        if ($user->isClient() && !$receiver->isSupplier()) {
            abort(403, 'Client can only message suppliers.');
        }

        if ($user->isSupplier() && !$receiver->isClient()) {
            abort(403, 'Supplier can only message clients.');
        }

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
            'supplier_id' => $request->supplier_id,
            'message' => $request->message,
        ]);

        return back();
    }

}
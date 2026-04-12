<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Message;
use App\Models\SupplierProfile;
use Illuminate\Http\Request;

class InquiryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function inbox()
    {
        
        $user = auth()->user();

        // ✅ Make sure supplier exists
        $supplier = $user->supplier;

        if (!$supplier) {
            return redirect()->back()->with('error', 'No supplier profile found.');
            // or: abort(404);
        }
        
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
        
        // 💬 CLIENT MESSAGES
        $clientMessages = Message::with('sender')
            ->where('supplier_id', $supplier->id)
            ->latest()
            ->get()
            ->unique('sender_id');

        // 📩 GUEST INQUIRIES
        $inquiries = Inquiry::where('supplier_id', $supplier->id)
            ->latest()
            ->get();
        
        return view('supplier.inquiries.inbox', compact( 'clientMessages','inquiries' , 'supplier' ,'conversations'));
    }

    public function chatbox()
    {

        
        return view('supplier.messages.chatbox');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 🔥 IF LOGGED-IN → REDIRECT TO CHAT (NO INQUIRY)
            if (auth()->check()) {
                return redirect()->route('chat.index', $request->supplier_id);
            }

            // ✅ GUEST ONLY (INQUIRY FORM)
            $request->validate([
                'supplier_id' => 'required|exists:supplier_profiles,id',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            Inquiry::create([
                'user_id' => null,
                'supplier_id' => $request->supplier_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

        return back()->with('success', 'Inquiry sent successfully!');
    }
    
    public function markAsRead($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $inquiry->update([
            'is_read' => true
        ]);

        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Inquiry $inquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquiry $inquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        
        return redirect()->route('supplier.inquiries.inbox')->with('success', 'Inquiry deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Booking;
use App\Models\BidMessage;
use Illuminate\Http\Request;

class SupplierBidController extends Controller
{
    public function index()
    {

        $bids = Bid::with([
            'package',
            'client',
            'latestMessage'
        ])
        ->where('supplier_id', auth()->id())
        ->latest()
        ->get();

        return view('supplier.bids.index', compact('bids'));
    }

    public function show(Bid $bid)
    {
        if ($bid->supplier_id != auth()->id()) {
            abort(403);
        }

        $bid->load([
            'package',
            'client',
            'event',
            'messages.sender'
        ]);

        return view('supplier.bids.show', compact('bid'));
    }

    public function counter(Request $request, Bid $bid)
    {
        $request->validate([
            'offer_price' => 'required|numeric|min:1',
            'message' => 'nullable|string'
        ]);

        BidMessage::create([
            'bid_id' => $bid->id,
            'sender_id' => auth()->id(),
            'offer_price' => $request->offer_price,
            'message' => $request->message,
        ]);

        $bid->update([
            'status' => 'pending'
        ]);

        return back()->with('success', 'Counter offer sent.');
    }

        public function accept(Bid $bid)
    {
        if ($bid->supplier_id != auth()->id()) {
            abort(403);
        }

        $latestOffer = $bid->messages()->latest()->first();

        if (!$latestOffer) {
            return back()->with(
                'error',
                'No offer found.'
            );
        }

        if ($bid->status === 'accepted') {
            return back()->with(
                'warning',
                'This bid has already been accepted.'
            );
        }

        $bid->update([
            'status' => 'accepted',
            'final_price' => $latestOffer->offer_price
        ]);

        Booking::firstOrCreate(
            [
                'event_id' => $bid->event_id,
                'package_id' => $bid->package_id,
                'supplier_id' => $bid->supplier_id,
            ],
            [
                'user_id' => $bid->client_id,
                'total_price' => $latestOffer->offer_price,
                'event_date' => $bid->event->event_date,
                'status' => 'confirmed',
            ]
        );

        return back()->with(
            'success',
            'Offer accepted and booking created.'
        );
    }

    public function reject(Bid $bid)
    {
        $bid->update([
            'status' => 'rejected'
        ]);

        return back()->with(
            'success',
            'Bid rejected.'
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Booking;
use App\Models\BidMessage;
use App\Models\Package;
use Illuminate\Http\Request;

class ClientBidController extends Controller
{
    public function store(Request $request, Package $package)
    {
        $request->validate([
            'event_id'    => 'required',
            'offer_price' => 'required|numeric|min:1',
            'message'     => 'nullable|string|max:1000',
        ]);

            // Prevent duplicate bids for the same package and event
            $existingBid = Bid::where('event_id', $request->event_id)
                ->where('package_id', $package->id)
                ->where('client_id', auth()->id())
                ->whereIn('status', ['pending', 'accepted'])
                ->exists();

            if ($existingBid) {
                return back()->with(
                    'error',
                    'You have already submitted a bid for this package.'
                );
            }

        $bid = Bid::firstOrCreate(
            [
                'event_id'    => $request->event_id,
                'package_id'  => $package->id,
                'client_id'   => auth()->id(),
                'supplier_id' => $package->supplier->user_id,
            ],
            [
                'status' => 'pending',
            ]
        );

        BidMessage::create([
            'bid_id'      => $bid->id,
            'sender_id'   => auth()->id(),
            'offer_price' => $request->offer_price,
            'message'     => $request->message,
        ]);

        return back()->with('success', 'Offer sent successfully.');
    }

    public function index()
    {
        $bids = Bid::with([
            'package',
            'supplier',
            'latestMessage'
        ])
        ->where('client_id', auth()->id())
        ->latest()
        ->get();

        return view('client.bids.index', compact('bids'));
    }

    public function show(Bid $bid)
    {
        abort_if($bid->client_id != auth()->id(), 403);

        $bid->load([
            'package',
            'supplier',
            'messages.sender'
        ]);

        return view('client.bids.show', compact('bid'));
    }

    public function reply(Request $request, Bid $bid)
    {
        abort_if($bid->client_id != auth()->id(), 403);

        $request->validate([
            'offer_price' => 'required|numeric|min:1',
            'message'     => 'nullable|string|max:1000',
        ]);

        BidMessage::create([
            'bid_id'      => $bid->id,
            'sender_id'   => auth()->id(),
            'offer_price' => $request->offer_price,
            'message'     => $request->message,
        ]);

        $bid->update([
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Counter offer sent successfully.'
        );
    }

   public function accept(Bid $bid)
{
    $latestOffer = $bid->messages()
        ->latest()
        ->first();

    $bid->update([
        'status' => 'accepted',
        'final_price' => $latestOffer->offer_price
    ]);

    Booking::create([
        'user_id' => $bid->client_id,
        'event_id' => $bid->event_id,
        'package_id' => $bid->package_id,
        'supplier_id' => $bid->package->supplier_id,
        'total_price' => $latestOffer->offer_price,
        'event_date' => $bid->event->event_date,
        'status' => 'confirmed'
    ]);

    return redirect()
        ->route('client.bookings.index')
        ->with(
            'success',
            'Offer accepted and booking created.'
        );
}
}
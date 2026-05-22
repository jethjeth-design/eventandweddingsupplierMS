<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\PopularPackageItem;
use Illuminate\Support\Facades\DB;
class BidController extends Controller
{
    /*
    |──────────────────────────────
    | CREATE BID
    |──────────────────────────────
    */
    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'type' => 'required|in:supplier,package,bundle_item',
            'supplier_id' => 'nullable|exists:users,id',
            'package_id' => 'nullable|exists:packages,id',
            'popular_package_item_id' => 'nullable|exists:popular_package_items,id',
            'event_id' => 'nullable|exists:events,id',
            'offer_price' => 'required|numeric|min:1',
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        abort_unless(
            $conversation->participants()
                ->where('user_id', auth()->id())
                ->exists(),
            403
        );

        $basePrice = 0;

        // ─────────────────────────────
        // SUPPLIER BID
        // ─────────────────────────────
        if ($request->type === 'supplier') {

            $supplier = User::with('supplier')
                ->findOrFail($request->supplier_id);

            $basePrice = $supplier->supplier->starting_price ?? 0;
        }

        // ─────────────────────────────
        // PACKAGE BID
        // ─────────────────────────────
        if ($request->type === 'package') {

            $package = Package::findOrFail($request->package_id);
            $basePrice = $package->price;
        }

        // ─────────────────────────────
        // BUNDLE ITEM BID
        // ─────────────────────────────
        if ($request->type === 'bundle_item') {

            $item = PopularPackageItem::with('package')
                ->findOrFail($request->popular_package_item_id);

            $basePrice = $item->package->price ?? 0;
        }

        Bid::create([
            'conversation_id' => $conversation->id,
            'client_id' => auth()->id(),
            'supplier_id' => $request->supplier_id,
            'package_id' => $request->package_id,
            'popular_package_item_id' => $request->popular_package_item_id,
            'type' => $request->type,
            'base_price' => $basePrice,
            'offer_price' => $request->offer_price,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Bid sent successfully.');
    }

    /*
    |──────────────────────────────
    | RESPOND TO BID (AUTO BOOKING FIXED)
    |──────────────────────────────
    */
    public function respond(Request $request, Bid $bid)
{
    $request->validate([
        'status' => 'required|in:accepted,rejected,countered',
        'counter_price' => 'nullable|numeric|min:1',
    ]);

    DB::beginTransaction();

    try {

        /*
        |──────────────────────────────
        | UPDATE BID STATUS
        |──────────────────────────────
        */
        $bid->update([
            'status' => $request->status,
        ]);

        /*
        |──────────────────────────────
        | COUNTER OFFER
        |──────────────────────────────
        */
        if ($request->status === 'countered') {

            $bid->update([
                'counter_price' => $request->counter_price
            ]);

            DB::commit();
            return back()->with('success', 'Counter offer sent.');
        }

        /*
        |──────────────────────────────
        | AUTO BOOKING ON ACCEPT
        |──────────────────────────────
        */
        if ($request->status === 'accepted') {

            // ⚠️ FIX: Bid may not directly have event_id
            $event = Event::find($bid->event_id ?? null);

            if (!$event) {
                DB::rollBack();
                return back()->with('error', 'Event not found.');
            }

            /*
            |──────────────────────────────
            | PREVENT DUPLICATE BOOKING
            |──────────────────────────────
            */
            $exists = Booking::where('event_id', $event->id)
                ->where('package_id', $bid->package_id)
                ->where('supplier_id', $bid->supplier_id)
                ->exists();

            if (!$exists) {

                Booking::create([
                    'user_id'     => $bid->client_id,
                    'event_id'    => $event->id,
                    'package_id'  => $bid->package_id,
                    'supplier_id' => $bid->supplier_id,
                    'event_date'  => $event->event_date,

                    // safest price logic
                    'total_price' => $bid->offer_price ?? $bid->base_price,

                    'status'      => 'confirmed', // ✅ better than pending for accepted bid
                ]);
            }
        }

        DB::commit();

        return back()->with('success', 'Bid updated successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}
}

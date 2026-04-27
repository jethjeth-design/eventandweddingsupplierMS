<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Booking;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // 🔒 Only owner can rate
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // 🔒 Only completed bookings
        if ($booking->event_date > now()) {
            return back()->with('error', 'You can rate after the event.');
        }

        // ❌ Prevent duplicate rating
        if ($booking->rating) {
            return back()->with('error', 'Already rated.');
        }

        Rating::create([
            'booking_id' => $booking->id,
            'supplier_id' => $booking->supplier_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }

    public function reviews()
    {
        $supplier = auth()->user()->supplier;

        $supplier->load([
            'ratings.user'
        ]);

        $average = round($supplier->ratings->avg('rating'), 1);

        return view('supplier.reviews.index', compact('supplier', 'average'));
    }
}
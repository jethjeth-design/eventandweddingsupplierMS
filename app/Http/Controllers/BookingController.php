<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'event_id' => 'required|exists:events,id',
        ]);

        // 🔥 CHECK FIRST (before inserting)
        $exists = Booking::where('user_id', auth()->id())
            ->where('package_id', $request->package_id)
            ->where('event_id', $request->event_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already booked this package.');
        }

        $package = Package::findOrFail($request->package_id);

        Booking::create([
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'event_id' => $request->event_id,
            'total_price' => $package->price,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('client.show', $request->event_id)
            ->with('success', 'Package booked successfully!');
    }
}
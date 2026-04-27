<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $bookings = Booking::with(['event', 'package.supplier'])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $totalBookings = $bookings->count();
        $pending = $bookings->where('status', 'pending')->count();
        $confirmed = $bookings->where('status', 'confirmed')->count();
        $completed = $bookings->filter(function ($booking) {
            return $booking->event_date < now();
        })->count();

        return view('client.dashboard', compact(
            'bookings',
            'totalBookings',
            'pending',
            'confirmed',
            'completed'
        ));
    }
}
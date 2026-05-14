<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\PopularPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function dashboard(Request $request)
{
    $from = $request->from;
    $to   = $request->to;

    return view('admin.dashboard', [
        'totalEvents' => Event::count(),
        'totalBookings' => Booking::count(),
        'confirmedBookings' => Booking::where('status', 'confirmed')->count(),
        'pendingBookings' => Booking::where('status', 'pending')->count(),
        'cancelledBookings' => Booking::where('status', 'cancelled')->count(),

        'confirmedRevenue' => Booking::where('status', 'confirmed')->sum('total_price'),

        // 📊 FIX: ADD THIS (this is what your Blade expects)
        'monthlyRevenue' => Booking::selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as month,
                SUM(CASE WHEN status = 'confirmed' THEN total_price ELSE 0 END) as revenue
            ")
            ->groupBy('month')
            ->orderBy('month')
            ->get(),

        'eventTypes' => Event::selectRaw('event_type, COUNT(*) as total')
            ->groupBy('event_type')
            ->get(),

        'bookingsByDate' => Booking::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get(),
    ]);
}
}
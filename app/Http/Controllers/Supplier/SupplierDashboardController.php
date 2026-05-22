<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Message;
use Illuminate\Http\Request;

class SupplierDashboardController extends Controller
{
    public function dashboard()
{
    $supplier = auth()->user()->supplier;

    // 📦 My Packages
    $packages = Package::where('supplier_id', $supplier->id)->get();

    // 📅 My Bookings
    $bookings = Booking::with(['event', 'user', 'package'])
        ->where('supplier_id', $supplier->id)
        ->latest()
        ->get();

    // 💰 Revenue (ONLY confirmed bookings)
    $revenue = Booking::where('supplier_id', $supplier->id)
        ->where('status', 'confirmed')
        ->sum('total_price');

    // ⏳ Pending requests
    $pending = Booking::where('supplier_id', $supplier->id)
        ->where('status', 'pending')
        ->count();

    // ❌ Cancelled
    $cancelled = Booking::where('supplier_id', $supplier->id)
        ->where('status', 'cancelled')
        ->count();



    return view('supplier.dashboard', compact(
        'packages',
        'bookings',
        'revenue',
        'pending',
        'cancelled',
    ));
}
}

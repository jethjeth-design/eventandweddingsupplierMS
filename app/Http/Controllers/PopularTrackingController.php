<?php

namespace App\Http\Controllers;

use App\Models\PopularPackage;

class PopularTrackingController extends Controller
{
    public function index()
    {
        $popularPackages = PopularPackage::withCount([
                'bookings'
            ])
            ->with([
                'bookings'
            ])
            ->get()
            ->map(function ($package) {

                // ✅ ONLY CONFIRMED BOOKINGS COUNT AS REVENUE
                $package->revenue = $package->bookings
                    ->where('status', 'confirmed')
                    ->sum('total_price');

                // Optional extra stats (recommended)
                $package->pending_revenue = $package->bookings
                    ->where('status', 'pending')
                    ->sum('total_price');

                $package->cancelled_revenue = $package->bookings
                    ->where('status', 'cancelled')
                    ->sum('total_price');

                return $package;
            });

        return view('admin.popular.tracking', compact('popularPackages'));
    }

    public function show($id)
    {
        $package = PopularPackage::with([
                'items.package',
                'items.supplier',
                'bookings.user',
                'bookings.event',
                'bookings.package'
            ])
            ->findOrFail($id);

        // ✅ FIX revenue breakdown here too
        $package->revenue = $package->bookings
            ->where('status', 'confirmed')
            ->sum('total_price');

        return view('admin.popular.show', compact('package'));
    }
}
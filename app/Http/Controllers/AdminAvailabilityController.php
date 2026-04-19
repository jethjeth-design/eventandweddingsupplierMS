<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierAvailability;
use App\Models\SupplierProfile;

class AdminAvailabilityController extends Controller
{
    // Calendar page
    public function index()
    {
        $suppliers = SupplierProfile::all();

        return view('admin.calendar.index', compact('suppliers'));
    }

    // Load ALL events
    public function events(Request $request)
    {
        $query = SupplierAvailability::with('supplier');

        // 🔥 FILTER BY SUPPLIER
        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $events = $query->get()->map(function ($item) {

            return [
                'title' => ($item->supplier->business_name ?? 'Supplier')
                            . ' - ' . ucfirst($item->status),

                'start' => $item->date,

                // 🎨 COLOR BASED ON STATUS
                'color' => match ($item->status) {
                    'available' => '#28a745',
                    'booked' => '#dc3545',
                    'unavailable' => '#6c757d',
                    default => '#007bff'
                },

                'extendedProps' => [
                    'supplier' => $item->supplier->business_name ?? 'Unknown',
                    'status' => $item->status
                ]
            ];
        });

        return response()->json($events);
    }

    private function colorByStatus($status)
    {
        return match ($status) {
            'available' => '#28a745',   // green
            'booked' =>    '#6c757d', // gray
            'unavailable' => '#dc3545',  // red
            default => '#007bff'
        };
    }
}
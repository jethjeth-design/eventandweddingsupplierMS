<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierAvailability;

class SupplierAvailabilityController extends Controller
{
    // Show calendar page
    public function index()
    {
        return view('supplier.availability.index');
    }

    // Load events for FullCalendar
    public function events()
    {
        $supplier = auth()->user()->supplier;

        return SupplierAvailability::where('supplier_id', $supplier->id)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => ucfirst($item->status),
                    'start' => $item->date,
                    'color' => match ($item->status) {
                        'available' => 'green',
                        'unavailable' => 'red',
                        'booked' => 'gray',
                    }
                ];
            });
    }

    // Save or update availability
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:available,unavailable,booked'
        ]);

        $supplier = auth()->user()->supplier;

        SupplierAvailability::updateOrCreate(
            [
                'supplier_id' => $supplier->id,
                'date' => $request->date
            ],
            [
                'status' => $request->status
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }
}
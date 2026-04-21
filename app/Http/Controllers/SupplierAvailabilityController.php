<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierAvailability;
use Carbon\Carbon;

class SupplierAvailabilityController extends Controller
{
    public function index()
    {
        return view('supplier.availability.calendar');
    }

    // 📅 LOAD CALENDAR EVENTS (AUTO STATUS)
    public function events()
    {
        $supplier = auth()->user()->supplier;
        $today = Carbon::today();

        return SupplierAvailability::where('supplier_id', $supplier->id)
            ->get()
            ->map(function ($item) use ($today) {

                // 🔥 AUTO STATUS ENGINE (TIMELINE LOGIC)
                $status = $this->autoStatus($item, $today);

                return [
                    'id' => $item->id,
                    'title' => ucfirst($status),
                    'start' => $item->date,

                    'color' => $this->colorByStatus($status),

                    'extendedProps' => [
                        'status' => $status
                    ]
                ];
            });
    }

    // 🧠 AUTO STATUS LOGIC (IMPORTANT FIX)
    private function autoStatus($item, $today)
    {
        // 🔴 EVENT ENDED → COMPLETED
        if ($item->date < $today) {
            return 'completed';
        }

        // 🟠 BOOKED (UPCOMING OR TODAY)
        if ($item->status === 'booked') {
            return 'booked';
        }

        // 🟡 PENDING (if you use it later)
        if ($item->status === 'pending') {
            return 'pending';
        }

        // 🟢 DEFAULT
        return $item->status ?? 'available';
    }

    // 🎨 COLORS (TIMELINE STYLE)
    private function colorByStatus($status)
    {
        return match ($status) {

            'available' => '#28a745',   // green
            'booked'    => '#fd7e14',   // orange
            'pending'   => '#ffc107',   // yellow
            'completed' => '#6c757d',   // gray

            default => '#007bff'
        };
    }

    // 💾 STORE
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

        return response()->json(['success' => true]);
    }

    // ✏️ UPDATE
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:supplier_availabilities,id',
            'status' => 'required|in:available,unavailable,booked'
        ]);

        $availability = SupplierAvailability::where('id', $request->id)
            ->where('supplier_id', auth()->user()->supplier->id)
            ->firstOrFail();

        $availability->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    // 🗑 DELETE
    public function destroy($id)
    {
        $availability = SupplierAvailability::where('id', $id)
            ->where('supplier_id', auth()->user()->supplier->id)
            ->first();

        if (!$availability) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $availability->delete();

        return response()->json(['success' => true]);
    }
}
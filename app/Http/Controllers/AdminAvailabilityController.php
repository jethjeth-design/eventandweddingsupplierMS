<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierAvailability;
use App\Models\SupplierProfile;
use Carbon\Carbon;

class AdminAvailabilityController extends Controller
{
    public function index()
    {
        $suppliers = SupplierProfile::all();

        return view('admin.calendar.index', compact('suppliers'));
    }

    // 🔥 MAIN EVENTS (AUTO STATUS LOGIC)
    public function events(Request $request)
    {
        $today = Carbon::today();

        $query = SupplierAvailability::with('supplier');

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $events = $query->get()->map(function ($item) use ($today) {

            $status = $this->autoStatus($item, $today);

            return [
                'id' => $item->id,

                'title' =>
                    ($item->supplier->business_name ?? 'Supplier')
                    . ' - ' . ucfirst($status),

                'start' => $item->date,

                'color' => $this->colorByStatus($status),

                'extendedProps' => [
                    'supplier' => $item->supplier->business_name ?? 'Unknown',
                    'status' => $status,
                ]
            ];
        });

        return response()->json($events);
    }

    // 🔥 AUTO STATUS ENGINE (IMPORTANT)
    private function autoStatus($item, $today)
    {
        // 1. PAST DATE → COMPLETED (AUTO)
        if ($item->date < $today) {
            return 'completed';
        }

        // 2. TODAY + BOOKED
        if ($item->status === 'booked') {
            return 'booked';
        }

        // 3. PENDING STATE (MONITORING)
        if ($item->status === 'pending') {
            return 'pending';
        }

        // 4. DEFAULT
        return $item->status ?? 'available';
    }

    // 🎨 COLORS
    private function colorByStatus($status)
    {
        return match ($status) {

            'available' => '#28a745',   // green
            'pending'   => '#ffc107',   // yellow
            'booked'    => '#dc3545',   // red
            'completed' => '#6c757d',   // gray

            default => '#007bff'
        };
    }
}
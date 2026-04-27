<?php

namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use App\Models\SupplierAvailability;
use Carbon\Carbon;

class ClientCalendarController extends Controller
{
    public function show($id)
    {
        $supplier = SupplierProfile::findOrFail($id);

        return view('client.calendar.availability', compact('supplier'));
    }

    public function events($id)
    {
        $today = Carbon::today();

        return SupplierAvailability::where('supplier_id', $id)
            ->get()
            ->map(function ($item) use ($today) {

                // AUTO STATUS
                if ($item->date < $today) {
                    $status = 'completed';
                } else {
                    $status = $item->status;
                }

                return [
                    'title' => ucfirst($status),
                    'start' => $item->date,

                    'color' => match ($status) {
                        'available' => '#28a745',
                        'booked' => '#fd7e14',
                        'unavailable' => '#dc3545',
                        'completed' => '#6c757d',
                        default => '#007bff'
                    }
                ];
            });
    }
}

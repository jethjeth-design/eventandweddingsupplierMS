<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Package;
use App\Models\SupplierAvailability;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    //To view the booking history of the client
    public function clientIndex()
    {
        $bookings = Booking::with(['event', 'package.supplier'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.booking.index', compact('bookings'));
    }

    // Timeline view for clients
    public function timeline()
    {
        $bookings = Booking::with([
            'event',
            'package.supplier'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

        return view('client.booking.timeline', compact('bookings'));
    }

    // Timeline view for admin
    public function adminTimeline()
    {
        $bookings = Booking::with([
            'event',
            'package.supplier'
        ])
        ->latest()
        ->get();

        return view('admin.booking.timeline', compact('bookings'));
    }
    // =========================
    // SUPPLIER: VIEW BOOKINGS
    // =========================
    public function supplierIndex()
    {
        $supplierId = auth()->user()->supplier->id;

        $bookings = Booking::with(['event', 'package'])
            ->where('supplier_id', $supplierId)
            ->latest()
            ->get();

        return view('supplier.booking.index', compact('bookings'));
    }

    // =========================
    // ADMIN: VIEW ALL BOOKINGS
    // =========================
    public function adminIndex(Request $request)
    {
        $query = Booking::with(['event', 'package.supplier']);

        // 🔍 SEARCH
        if ($request->search) {
            $query->whereHas('event', function ($q) use ($request) {
                $q->where('event_name', 'like', '%' . $request->search . '%');
            })->orWhereHas('package.supplier', function ($q) use ($request) {
                $q->where('business_name', 'like', '%' . $request->search . '%');
            });
        }

        // 🔽 FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->get();

        return view('admin.booking.index', compact('bookings'));
    }
    // =========================
    // CLIENT: CREATE BOOKING
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'package_id' => 'required|exists:packages,id',
        ]);

        $event = Event::findOrFail($request->event_id);
        $package = Package::findOrFail($request->package_id);

        // prevent duplicate booking
        $exists = Booking::where('event_id', $event->id)
            ->where('package_id', $package->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Already booked this package.');
        }

        // create booking (PENDING)
        Booking::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'package_id' => $package->id,
            'supplier_id' => $package->supplier_id,
            'event_date' => $event->event_date ?? now(),
            'total_price' => $package->price,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Booking sent to supplier.');
    }


    // =========================
    // SUPPLIER: ACCEPT BOOKING
    // =========================
    public function approve($id)
    {
        $booking = Booking::where('supplier_id', auth()->user()->supplier->id)
            ->findOrFail($id);

        $booking->update([
            'status' => 'confirmed'
        ]);

        // lock calendar
        SupplierAvailability::updateOrCreate(
            [
                'supplier_id' => $booking->supplier_id,
                'date' => $booking->event_date,
            ],
            [
                'status' => 'booked'
            ]
        );

        return back()->with('success', 'Booking approved!');
    }

    // =========================
    // SUPPLIER: REJECT BOOKING
    // =========================
    public function cancel($id)
    {
        $booking = Booking::where('supplier_id', auth()->user()->supplier->id)
            ->findOrFail($id);

        $booking->update([
            'status' => 'cancelled'
        ]);

        // release calendar
        SupplierAvailability::updateOrCreate(
            [
                'supplier_id' => $booking->supplier_id,
                'date' => $booking->event_date,
            ],
            [
                'status' => 'available'
            ]
        );

        return back()->with('error', 'Booking cancelled.');
    }
}
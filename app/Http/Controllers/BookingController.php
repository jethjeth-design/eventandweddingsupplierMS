<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
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
        $search    = $request->input('search');
        $status    = $request->input('status');
        $eventType = $request->input('event_type');
        $dateFrom  = $request->input('date_from');
        $dateTo    = $request->input('date_to');
    
        // ── Base query ──
        $query = Booking::query()
            ->with([
                'event',
                'user',
                'package',
                'package.supplier',
            ])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->whereHas('event', fn($e) =>
                            $e->where('event_name', 'like', "%{$search}%")
                            ->orWhere('event_type', 'like', "%{$search}%")
                        )
                        ->orWhereHas('user', fn($u) =>
                            $u->where('name', 'like', "%{$search}%")
                        )
                        ->orWhereHas('package', fn($p) =>
                            $p->where('name', 'like', "%{$search}%")
                        )
                        ->orWhereHas('package.supplier', fn($s) =>
                            $s->where('business_name', 'like', "%{$search}%")
                            ->orWhere('first_name',   'like', "%{$search}%")
                            ->orWhere('last_name',    'like', "%{$search}%")
                        );
                });
            })
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($eventType, fn($q) =>
                $q->whereHas('event', fn($e) => $e->where('event_type', $eventType))
            )
            ->when($dateFrom, fn($q) => $q->whereDate('event_date', '>=', $dateFrom))
            ->when($dateTo,   fn($q) => $q->whereDate('event_date', '<=', $dateTo))
            ->latest();
    
        $bookings = $query->paginate(20)->withQueryString();
    
        // ── Stats (always from full dataset, no filters) ──
        $allStats = [
            'pending'   => \App\Models\Booking::where('status', 'pending')->count(),
            'confirmed' => \App\Models\Booking::where('status', 'confirmed')->count(),
            'cancelled' => \App\Models\Booking::where('status', 'cancelled')->count(),
            'revenue'   => \App\Models\Booking::where('status', 'confirmed')->sum('total_price'),
        ];

        return view('admin.booking.index', compact('bookings', 'allStats'));
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

        // ✅ CREATE BOOKING
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'package_id' => $package->id,
            'supplier_id' => $package->supplier_id,
            'event_date' => $event->event_date ?? now(),
            'total_price' => $package->price,
            'status' => 'pending',
        ]);

        // =========================
        // 🔔 NOTIFY SUPPLIER
        // =========================
        $supplierUser = $package->supplier->user ?? null;

        if ($supplierUser) {
            $supplierUser->notify(new SystemNotification(
                'New Booking',
                'A client booked your package.',
                route('supplier.booking.index')
            ));
        }

        // =========================
        // 🔔 NOTIFY ADMIN
        // =========================
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new SystemNotification(
                'New Booking',
                'A new booking needs monitoring.',
                route('admin.booking.index')
            ));
        }

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

        // =========================
        // 🔔 NOTIFY CLIENT
        // =========================
        $booking->user?->notify(new SystemNotification(
            'Booking Confirmed',
            'Your booking has been approved.',
            route('client.bookings.index')
        ));

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

        // =========================
        // 🔔 NOTIFY CLIENT
        // =========================
        $booking->user?->notify(new SystemNotification(
            'Booking Cancelled',
            'Your booking was rejected by supplier.',
            route('client.bookings.index')
        ));

        return back()->with('error', 'Booking cancelled.');
    }

}
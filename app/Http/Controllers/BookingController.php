<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Package;
use App\Notifications\SupplierProfile;
use App\Notifications\SystemNotification;
use App\Models\SupplierAvailability;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    // ── Client: booking history ───────────────────────────────────────────
    public function clientIndex()
    {
        $bookings = Booking::with(['event', 'package.supplier'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.booking.index', compact('bookings'));
    }

    // ── Client: timeline ─────────────────────────────────────────────────
    public function timeline()
    {
        $bookings = Booking::with(['event', 'package.supplier'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.booking.timeline', compact('bookings'));
    }

    // ── Admin: timeline ──────────────────────────────────────────────────
    public function adminTimeline()
    {
        $bookings = Booking::with(['event', 'package.supplier'])
            ->latest()
            ->get();

        return view('admin.booking.timeline', compact('bookings'));
    }

    // ── Supplier: view bookings ──────────────────────────────────────────
    public function supplierIndex()
    {
        $supplierId = auth()->user()->supplier->id;

        $bookings = Booking::with(['event', 'package'])
            ->where('supplier_id', $supplierId)
            ->latest()
            ->get();

        return view('supplier.booking.index', compact('bookings'));
    }

    // ── Admin: all bookings ──────────────────────────────────────────────
    public function adminIndex(Request $request)
{
    $search    = $request->input('search');
    $status    = $request->input('status');
    $eventType = $request->input('event_type');
    $dateFrom  = $request->input('date_from');
    $dateTo    = $request->input('date_to');

    $query = Booking::query()
        ->with([
            'event',
            'user',
            'package',
            'package.supplier',
            'popularPackage'
        ])

        // SEARCH
        ->when($search, function ($q) use ($search) {
            $q->where(function ($q2) use ($search) {

                $q2->whereHas('event', function ($e) use ($search) {
                        $e->where('event_name', 'like', "%{$search}%")
                          ->orWhere('event_type', 'like', "%{$search}%");
                    })

                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('package', function ($p) use ($search) {
                        $p->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('package.supplier', function ($s) use ($search) {
                        $s->where('business_name', 'like', "%{$search}%")
                          ->orWhere('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('popularPackage', function ($pp) use ($search) {
                        $pp->where('name', 'like', "%{$search}%");
                    });
            });
        })

        // STATUS FILTER
        ->when($status, fn($q) => $q->where('status', $status))

        // EVENT TYPE FILTER
        ->when($eventType, fn($q) =>
            $q->whereHas('event', fn($e) =>
                $e->where('event_type', $eventType)
            )
        )

        // DATE FILTER
        ->when($dateFrom, fn($q) =>
            $q->whereDate('event_date', '>=', $dateFrom)
        )
        ->when($dateTo, fn($q) =>
            $q->whereDate('event_date', '<=', $dateTo)
        )

        ->latest();

    $bookings = $query->paginate(20)->withQueryString();

    // ─────────────────────────────────────────────
    // STATS (UPDATED FOR BUNDLES)
    // ─────────────────────────────────────────────
    $allStats = [
        'pending'   => Booking::where('status', 'pending')->count(),
        'confirmed' => Booking::where('status', 'confirmed')->count(),
        'completed' => Booking::where('status', 'completed')->count(),
        'cancelled' => Booking::where('status', 'cancelled')->count(),

        'revenue'   => Booking::where('status', 'confirmed')
                            ->sum('total_price'),

        // 🔥 NEW: bundle tracking
        'bundle_bookings' => Booking::whereNotNull('popular_package_id')->count(),
    ];

    return view('admin.booking.index', compact('bookings', 'allStats'));
}

    // ── Client: create booking ───────────────────────────────────────────
    public function store(Request $request)
    {
        // Normal single-package booking
        if ($request->filled('package_id')) {

            $request->validate([
                'event_id'   => 'required|exists:events,id',
                'package_id' => 'required|exists:packages,id',
            ]);

            $event   = Event::findOrFail($request->event_id);
            $package = Package::with('supplier')->findOrFail($request->package_id);

            $exists = Booking::where('event_id', $event->id)
                ->where('package_id', $package->id)
                ->exists();

            if ($exists) {
                return back()->with('error', 'Already booked this package.');
            }

            Booking::create([
                'user_id'     => auth()->id(),
                'event_id'    => $event->id,
                'package_id'  => $package->id,
                'supplier_id' => $package->supplier_id,
                'event_date'  => $event->event_date,
                'total_price' => $package->price,
                'status'      => 'pending',
            ]);

            $supplierUser = optional($package->supplier)->user;
            if ($supplierUser) {
                $supplierUser->notify(new SystemNotification(
                    'New Booking',
                    'A client booked your package.',
                    route('supplier.bookings')
                ));
            }

            return back()->with('success', 'Booking sent to supplier.');
        }

        // ═════════════════════════════════════════════════════════════
        // POPULAR PACKAGE / BUNDLE BOOKING
        // ═════════════════════════════════════════════════════════════

        if ($request->filled('popular_package_id')) {

            $request->validate([
                'event_id' => 'required|exists:events,id',
                'popular_package_id' => 'required|exists:popular_packages,id',
            ]);

            $event = Event::findOrFail($request->event_id);

            $popularPackage = \App\Models\PopularPackage::with([
                'items.package',
                'items.supplier.user'
            ])->findOrFail($request->popular_package_id);

            $created = 0;

            foreach ($popularPackage->items as $item) {

                // skip invalid bundle items
                if (!$item->package || !$item->supplier) {
                    continue;
                }

                // prevent duplicate bookings
                $exists = Booking::where('event_id', $event->id)
                    ->where('package_id', $item->package_id)
                    ->where('supplier_id', $item->supplier_id)
                    ->exists();

                if ($exists) {
                    continue;
                }

                // create booking
                $booking = Booking::create([
                    'user_id' => auth()->id(),
                    'event_id' => $event->id,

                    'popular_package_id' => $popularPackage->id,

                    'package_id' => $item->package_id,
                    'supplier_id' => $item->supplier_id,

                    'booking_type' => 'bundle',

                    'event_date' => $event->event_date,

                    'total_price' => $item->package->price,

                    'status' => 'pending',
                ]);

                // notify supplier
                $supplierUser = optional($item->supplier)->user;

                if ($supplierUser) {

                    $supplierUser->notify(
                        new SystemNotification(
                            'New Bundle Booking',
                            'A client booked a popular package containing your service.',
                            route('supplier.bookings')
                        )
                    );
                }

                $created++;
            }

            if ($created > 0) {

                return back()->with(
                    'success',
                    'Popular package booked successfully.'
                );
            }

            return back()->with(
                'error',
                'No bookings were created.'
            );
        }
    }

    // ═════════════════════════════════════════════════════════════════════
    // SUPPLIER: ACCEPT BOOKING
    // ── When supplier accepts → booking becomes 'confirmed'
    // ── Event status is upgraded to 'confirmed' (never downgraded)
    // ═════════════════════════════════════════════════════════════════════
    public function approve($id)
    {
        $booking = Booking::where('supplier_id', auth()->user()->supplier->id)
            ->findOrFail($id);

        // 1. Confirm the booking
        $booking->update(['status' => 'confirmed']);

        // 2. Mark supplier date as booked
        SupplierAvailability::updateOrCreate(
            [
                'supplier_id' => $booking->supplier_id,
                'date'        => $booking->event_date,
            ],
            ['status' => 'booked']
        );

        // 3. ✅ Upgrade event status to 'confirmed'
        //    Only upgrade — never overwrite 'completed' or 'cancelled'
        $event = $booking->event;
        if ($event && in_array($event->status, ['pending', 'planning', 'confirmed'])) {
            $event->update(['status' => 'confirmed']);
        }

        // 4. Notify client
        if ($booking->user) {
            $booking->user->notify(new SystemNotification(
                'Booking Confirmed',
                'Your booking has been approved by the supplier.',
                route('client.bookings.index')
            ));
        }

        return back()->with('success', 'Booking approved!');
    }

    // ═════════════════════════════════════════════════════════════════════
    // SUPPLIER: REJECT / CANCEL BOOKING
    // ── If this was the LAST confirmed booking on the event,
    //    revert event back to 'pending' so client knows action is needed
    // ═════════════════════════════════════════════════════════════════════
    public function cancel($id)
    {
        $booking = Booking::where('supplier_id', auth()->user()->supplier->id)
            ->findOrFail($id);

        $booking->update(['status' => 'cancelled']);

        SupplierAvailability::updateOrCreate(
            [
                'supplier_id' => $booking->supplier_id,
                'date'        => $booking->event_date,
            ],
            ['status' => 'available']
        );

        // ✅ If no active bookings remain, revert event to 'pending'
        $event = $booking->event;
        if ($event && $event->status === 'confirmed') {
            $hasActive = $event->bookings()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('id', '!=', $booking->id)
            ->exists();

            if (! $hasActive) {
                $event->update(['status' => 'pending']);
            }
        }

        // Notify client
        if ($booking->user) {
            $booking->user->notify(new SystemNotification(
                'Booking Cancelled',
                'Your booking was rejected by the supplier.',
                route('client.bookings.index')
            ));
        }

        return back()->with('error', 'Booking cancelled.');
    }

    public function complete($id)
    {
        $booking = Booking::where('supplier_id', auth()->user()->supplier->id)
            ->findOrFail($id);

        $booking->update([
            'status' => 'completed'
        ]);

        $event = $booking->event;

        if ($event) {

            // if all bookings are completed → mark event completed
            $hasPendingOrConfirmed = $event->bookings()
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if (!$hasPendingOrConfirmed) {
                $event->update([
                    'status' => 'completed'
                ]);
            }
        }

        if ($booking->user) {
            $booking->user->notify(
                new \App\Notifications\SystemNotification(
                    'Event Completed',
                    'Your event has been marked as completed.',
                    route('client.bookings.index')
                )
            );
        }

        return back()->with('success', 'Booking marked as completed.');
    }
}
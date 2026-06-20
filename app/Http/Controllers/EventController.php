<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Services\AIRecommendationService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // ── Client: list events ──────────────────────────────────────────────
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('event')->latest()->get();
        $events   = Event::where('user_id', auth()->id())->latest()->get();

        return view('client.events.index', compact('events', 'bookings'));
    }

    // ── Admin: list all events ───────────────────────────────────────────
    public function adminIndex(Request $request)
    {
        $search    = $request->input('search');
        $eventType = $request->input('event_type');
        $dateFrom  = $request->input('date_from');
        $dateTo    = $request->input('date_to');

        $query = Event::query()
            ->with('user')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('event_name', 'like', "%{$search}%")
                       ->orWhere('venue',      'like', "%{$search}%")
                       ->orWhere('event_type', 'like', "%{$search}%")
                       ->orWhereHas('user', fn($u) =>
                           $u->where('name', 'like', "%{$search}%")
                       );
                });
            })
            ->when($eventType, fn($q) => $q->where('event_type', $eventType))
            ->when($dateFrom,  fn($q) => $q->whereDate('event_date', '>=', $dateFrom))
            ->when($dateTo,    fn($q) => $q->whereDate('event_date', '<=', $dateTo))
            ->latest('event_date');

        $events = $query->paginate(25)->withQueryString();

        $stats = [
            'total'        => Event::count(),
            'avg_budget'   => Event::avg('budget')      ?? 0,
            'avg_guests'   => Event::avg('guest_count') ?? 0,
            'total_budget' => Event::sum('budget')      ?? 0,
            'this_month'   => Event::whereMonth('event_date', now()->month)
                                   ->whereYear('event_date', now()->year)
                                   ->count(),
        ];

        return view('admin.events.index', compact('events', 'stats'));
    }

    // ── Client: store new event ──────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'event_name'  => 'required|string|max:255',
            'event_type'  => 'required|string|max:255',
            'event_time'  => 'required|date_format:H:i',
            'event_date'  => 'required|date|after_or_equal:today',
            'budget'      => 'required|numeric|min:0',
            'guest_count' => 'nullable|integer|min:1',
            'venue'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $existingEvent = Event::where('user_id', auth()->id())
            ->whereDate('event_date', $request->event_date)
            ->whereIn('status', ['pending', 'confirmed', 'completed'])
            ->exists();

        if ($existingEvent) {
            return back()
                ->withInput()
                ->withErrors([
                    'event_date' => 'You already have an event scheduled on this date.'
                ]);
        }


        $event = Event::create([
            'user_id'        => auth()->id(),
            'event_name'     => $request->event_name,
            'event_type'     => $request->event_type,
            'event_time'     => $request->event_time,
            'event_date'     => $request->event_date,
            'budget'         => $request->budget,
            'guest_count'    => $request->guest_count,
            'venue'          => $request->venue,
            'description'    => $request->description,
            'is_recommended' => false,
            'recommended_at' => null,
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('client.show', $event->id)
            ->with('success', 'Event created successfully.');
    }

    public function create()
    {
        return view('client.events.create');
    }

    // ── Client: show single event ────────────────────────────────────────
    public function show($id)
    {
        $event = Event::findOrFail($id);

        $recommendations = app(AIRecommendationService::class)
            ->getRecommendations($event);

        return view('client.events.show', [
            'event'            => $event,
            'supplierPackages' => $recommendations['supplierPackages'] ?? collect(),
            'popularPackages'  => $recommendations['popularPackages']  ?? collect(),
        ]);
    }

    public function cancel($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (in_array($event->status, ['cancelled', 'completed'])) {
            return back()->with('error', 'This event cannot be cancelled.');
        }

        $event->update(['status' => 'cancelled']);

        // Cancel all active bookings (enum: pending | confirmed | cancelled)
        Booking::where('event_id', $event->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->update(['status' => 'cancelled']);

        // Notify admins — fixed bug: was $event->name, correct column is event_name
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\SystemNotification(
                'Event Cancelled',
                'A client cancelled an event: ' . $event->event_name,
                route('admin.bookings')
            ));
        }

        return back()->with('success', 'Event cancelled successfully.');
    }

    // ═════════════════════════════════════════════════════════════════════
    // CLIENT: COMPLETE EVENT  ← NEW
    // Route: PATCH /client/events/{id}/complete
    // Name:  client.events.complete
    //
    // Triggered by the "Mark Complete" button in the events table.
    // • Sets event  → 'completed'
    // • Cancels leftover 'pending' bookings (supplier never responded)
    // • Leaves 'confirmed' bookings alone (they were fulfilled)
    // ═════════════════════════════════════════════════════════════════════
    public function complete($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($event->status === 'cancelled') {
            return back()->with('error', 'Cannot complete a cancelled event.');
        }

        if ($event->status === 'completed') {
            return back()->with('error', 'Event is already marked as completed.');
        }

        $event->update(['status' => 'completed']);

        // Pending bookings whose supplier never responded get cancelled
        // Confirmed bookings stay confirmed — they were already delivered
        Booking::where('event_id', $event->id)
            ->where('status', 'pending')
            ->update(['status' => 'cancelled']);

        return back()->with('success', 'Event marked as completed.');
    }

    // ── Supplier matching ────────────────────────────────────────────────
    public function matching(Request $request)
    {
        $event = null;

        if ($request->filled('event_id')) {
            $event = Event::find($request->event_id);
        }

        $query = \App\Models\SupplierProfile::with([
            'packages.inclusions',
            'categories',
        ]);

        if ($request->filled('category')) {
            $query->whereHas('categories', fn($q) =>
                $q->where('id', $request->category)
            );
        }

        if ($request->filled('search')) {
            $query->where(fn($q) =>
                $q->where('business_name', 'like', '%' . $request->search . '%')
                  ->orWhere('city',     'like', '%' . $request->search . '%')
                  ->orWhere('province', 'like', '%' . $request->search . '%')
            );
        }

        if ($event) {
            $query->whereHas('packages', fn($q) =>
                $q->where('event_type', $event->event_type)
                  ->where('is_listed', true)
            );
        }

        $matchedPackages = $query->latest()->get();

        return view('client.supplier-matching', compact('event', 'matchedPackages'));
    }
    



    
}
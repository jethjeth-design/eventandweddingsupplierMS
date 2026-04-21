<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\AIRecommendationService;
use Illuminate\Http\Request;

class EventController extends Controller
{ 
    //Client and Admin Index methods to list events based on user role
    public function clientIndex()
    {
        $events = Event::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.events.index', compact('events'));
    }
    
    public function adminIndex(Request $request)
    {
        $search    = $request->input('search');
        $eventType = $request->input('event_type');
        $dateFrom  = $request->input('date_from');
        $dateTo    = $request->input('date_to');
    
        // ── Base query ──
        $query = \App\Models\Event::query()
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
    
        // ── Stats (full dataset, not filtered) ──
        $stats = [
            'total'        => \App\Models\Event::count(),
            'avg_budget'   => \App\Models\Event::avg('budget')      ?? 0,
            'avg_guests'   => \App\Models\Event::avg('guest_count') ?? 0,
            'total_budget' => \App\Models\Event::sum('budget')      ?? 0,
            'this_month'   => \App\Models\Event::whereMonth('event_date', now()->month)
                                                ->whereYear('event_date',  now()->year)
                                                ->count(),
        ];

        return view('admin.event.list', compact('events', 'stats'));
    }

    /**
     * Show the form for store a new resource.
     */
    public function store(Request $request)
{
    $request->validate([
        'event_type' => 'required',
        'budget' => 'required|numeric',
    ]);
    

    $event = Event::create([
        'user_id' => auth()->id(),
        'event_name' => $request->event_name,
        'event_type' => $request->event_type,
        'event_date' => $request->event_date,
        'budget' => $request->budget,
        'description' => $request->description,
        'guest_count' => $request->guest_count,
        'venue' => $request->venue,
    ]);

    // ✅ redirect ONLY (no AI here)
    return redirect()->route('client.show', $event->id);
    }
    public function create()
    {
        return view('client.events.create');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        $recommendations = app(\App\Services\AIRecommendationService::class)
            ->getRecommendedPackages($event);

        return view('client.events.show', compact('event', 'recommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}

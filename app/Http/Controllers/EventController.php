<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Theme;
use App\Models\SupplierProfile;
use App\Http\Controllers\AI\RecommendationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkClient();
        if (!auth()->check() || auth()->user()->role !== 'client') {
            abort(403, 'Client only');
        }
        $categories = Category::all();
        $themes =Theme::all();

        $events = Event::where('client_id', auth()->id())->get();
        return view('client.events.createvent', compact('events', 'categories', 'themes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkClient();

        $request->validate([
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'guest_count' => 'required|integer',
        ]);

        // ✅ CREATE EVENT
        $event = Event::create([
            'client_id' => auth()->id(),
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'budget' => $request->budget,
            'guest_count' => $request->guest_count,
            'theme' => $request->theme,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);
    // ✅ CALL AI CONTROLLER
        $ai = new RecommendationController();
        $suppliers = $ai->generateRecommendations($event);

        // ✅ ATTACH SUPPLIERS
        if (!empty($suppliers)) {
            $event->suppliers()->sync(collect($suppliers)->pluck('id'));
        }

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Event created with AI recommendations!');
    }
    
   

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('suppliers');

    return view('client.events.show', compact('event'));
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
    
     // =========================
    // CLIENT: CANCEL
    // =========================
    public function cancel($id)
    {
        $this->checkClient();

        $event = Event::where('client_id', Auth::id())->findOrFail($id);

        if ($event->status === 'approved') {
            return back()->with('error', 'Cannot cancel approved event');
        }

        $event->update(['status' => 'cancelled']);

        return back()->with('success', 'Event cancelled');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('client.events.index')->with('success', 'Event deleted successfully.');
    }

    // =========================
    // ADMIN: VIEW ALL EVENTS
    // =========================
    public function index()
    {
        $this->checkAdmin();
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Admin only');
        }
        $events = Event::with('client')->latest()->get();

        return view('admin.events.index', compact('events'));
    }

    // =========================
    // ADMIN: APPROVE
    // =========================
    public function approve($id)
    {
        $this->checkAdmin();

        $event = Event::findOrFail($id);
        $event->update(['status' => 'approved']);

        return back()->with('success', 'Event approved');
    }

    // =========================
    // ADMIN: REJECT
    // =========================
    public function reject($id)
    {
        $this->checkAdmin();

        $event = Event::findOrFail($id);
        $event->update(['status' => 'rejected']);

        return back()->with('success', 'Event rejected');
    }

    // =========================
    // 🔐 ROLE CHECK METHODS
    // =========================
    private function checkAdmin()
    {
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403, 'Admin only');
        }
    }

    private function checkClient()
    {
        if (!auth()->user() || auth()->user()->role !== 'client') {
            abort(403, 'Client only');
        }
    }

    
}

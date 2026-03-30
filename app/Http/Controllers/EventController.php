<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('client.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'guest_count' => 'required|integer',
            'theme' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Event::create([
            'client_id' => auth()->id(),
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'budget' => $request->budget,
            'guest_count' => $request->guest_count,
            'theme' => $request->theme,
            'notes' => $request->notes,
        ]);
         
            // 🔥 Redirect to AI recommendation
            return redirect()->route('ai.recommend', [
                'budget' => $event->budget
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
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

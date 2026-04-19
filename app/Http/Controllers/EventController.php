<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\AIRecommendationService;
use Illuminate\Http\Request;

class EventController extends Controller
{
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

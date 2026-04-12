<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Package;

class AIRecommendationService
{
    public function getRecommendedPackages(Event $event)
    {
        // Step 1: Get matching event type
        $query = Package::where('event_type', $event->event_type);

        // Step 2: Budget filter (priority logic)
        $query->orderByRaw("
            ABS(price - ?) ASC
        ", [$event->budget]);

        // Step 3: Limit results
        $packages = $query->take(10)->get();

        // Step 4: Add scoring (AI-like ranking)
        return $packages->map(function ($package) use ($event) {

            $score = $this->calculateScore($event, $package);

            $package->match_score = $score;

            if ($package->price <= $event->budget) {
                $package->tag = "Within Budget";
            } else {
                $package->tag = "Above Budget";
            }

            return $package;
        })->sortByDesc('match_score');
    }

    private function calculateScore($event, $package)
    {
        $score = 0;

        // Event type match (high priority)
        if ($event->event_type === $package->event_type) {
            $score += 50;
        }

        // Budget closeness
        $diff = abs($event->budget - $package->price);
        $score += max(0, 50 - ($diff / 100));

        // Guest capacity match (optional AI factor)
        if ($event->guest_count && $package->guest_capacity) {
            if ($package->guest_capacity >= $event->guest_count) {
                $score += 20;
            }
        }

        return $score;
    }
}
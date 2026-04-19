<?php

namespace App\Services;

use App\Models\Package;
use App\Models\Event;

class AIRecommendationService
{
    public function getRecommendedPackages(Event $event)
    {
        $packages = Package::with('inclusions')
            ->where('event_type', $event->event_type)
            ->get();

        return $packages->map(function ($package) use ($event) {

            $score = 0;

            // 🎯 match event type
            if ($package->event_type === $event->event_type) {
                $score += 40;
            }

            // 💰 budget match
            if ($package->price <= $event->budget) {
                $score += 30;
            } else {
                $score -= 20;
            }

            // 👥 guest match
            if ($package->guest_capacity >= $event->guest_count) {
                $score += 20;
            } else {
                $score -= 10;
            }

            // ⭐ bonus for cheap & high capacity value
            if ($package->price < $event->budget * 0.8) {
                $score += 10;
            }

            $package->score = $score;

            return $package;

        })->sortByDesc('score')->values();
    }
}
<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Package;
use App\Models\PopularPackage;

class AIRecommendationService
{
    public function getRecommendations(Event $event)
    {
        $eventType = strtolower($event->event_type);
        $budget    = $event->budget;
        $guests    = $event->guest_count ?? 0;
        $eventDate = $event->event_date;

        /*
        |--------------------------------------------------------------------------
        | SUPPLIER PACKAGES
        |--------------------------------------------------------------------------
        */

        $supplierPackages = Package::with(['supplier', 'inclusions'])
            ->where('is_listed', true)
            ->whereRaw('LOWER(event_type) = ?', [$eventType])

            // avoid already booked confirmed packages on same date
            ->whereDoesntHave('bookings', function ($q) use ($eventDate) {
                $q->where('event_date', $eventDate)
                  ->where('status', 'confirmed');
            })

            ->get()

            ->map(function ($package) use ($budget, $guests, $eventType) {

                $score = 0;

                /*
                | Event Match
                */
                if (strtolower($package->event_type) === $eventType) {
                    $score += 40;
                }

                /*
                | PRICE LOGIC (FIXED + NEGOTIABLE)
                */
                $effectiveMin = $package->is_negotiable ? $package->min_price : $package->price;
                $effectiveMax = $package->is_negotiable ? $package->max_price : $package->price;

                if ($effectiveMin <= $budget) {
                    $score += 30;
                } else {
                    $score -= 20;
                }

                /*
                | NEGOTIATION BONUS
                */
                if ($package->is_negotiable && $budget >= $package->min_price && $budget <= $package->max_price) {
                    $score += 15;
                }

                /*
                | GUEST CAPACITY
                */
                if ($package->guest_capacity) {
                    if ($package->guest_capacity >= $guests) {
                        $score += 20;
                    } else {
                        $score -= 10;
                    }
                }

                /*
                | VALUE DEAL
                */
                if ($effectiveMax < ($budget * 0.8)) {
                    $score += 10;
                }

                /*
                | FEATURED
                */
                if ($package->is_featured) {
                    $score += 5;
                }

                $package->score = $score;

                return $package;
            })

            ->sortByDesc('score')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | POPULAR PACKAGES (BUNDLES)
        |--------------------------------------------------------------------------
        */

        $popularPackages = PopularPackage::with([
                'inclusions',
                'items.package',
                'items.supplier'
            ])
            ->where('is_active', true)
            ->whereRaw('LOWER(event_type) = ?', [$eventType])
            ->get()

            ->map(function ($package) use ($budget, $guests, $eventType) {

                $score = 0;

                /*
                | Event Match
                */
                if (strtolower($package->event_type) === $eventType) {
                    $score += 50;
                }

                /*
                | BUNDLE TOTAL PRICE (IMPORTANT FIX)
                */
                $bundleTotal = $package->items->sum(function ($item) {
                    return optional($item->package)->price ?? 0;
                });

                if ($bundleTotal <= $budget) {
                    $score += 30;
                } else {
                    $score -= 15;
                }

                /*
                | GUEST CAPACITY
                */
                if ($package->guest_capacity) {
                    if ($package->guest_capacity >= $guests) {
                        $score += 20;
                    } else {
                        $score -= 10;
                    }
                }

                /*
                | BUNDLE COMPLETENESS
                */
                $count = $package->items->count();

                if ($count >= 3) {
                    $score += 15;
                } elseif ($count == 2) {
                    $score += 8;
                }

                /*
                | VALUE SCORE (NEW IMPROVEMENT)
                */
                if ($bundleTotal < ($budget * 0.75)) {
                    $score += 10;
                }

                $package->score = $score;

                return $package;
            })

            ->sortByDesc('score')
            ->values();

        return [
            'supplierPackages' => $supplierPackages,
            'popularPackages'  => $popularPackages,
        ];
    }
}
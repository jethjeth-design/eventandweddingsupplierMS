<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SupplierProfile;

class RecommendationController extends Controller
{
    /**
     * Generate AI supplier recommendations
     */
    public function recommend(Event $event)
    {
        $suppliers = $this->generateRecommendations($event);

        return $suppliers;
    }

    /**
     * Core AI logic
     */
    public function generateRecommendations(Event $event)
    {
        $budget = $event->budget;

        $allocation = $this->getBudgetAllocation($event->event_type);

        $recommended = [];

        foreach ($allocation as $category => $percent) {

            $allocatedBudget = $budget * $percent;

            $supplier = SupplierProfile::where('category', $category)
                ->where('price', '<=', $allocatedBudget)
                ->orderByDesc('price')
                ->first();

            if ($supplier) {
                $recommended[] = $supplier;
            }
        }

        return $recommended;
    }

    /**
     * Budget allocation by event type
     */
    private function getBudgetAllocation($eventType)
    {
        return match ($eventType) {

            'wedding' => [
                'photography' => 0.20,
                'catering' => 0.55,
                'decor' => 0.20,
                'others' => 0.05,
            ],

            'birthday' => [
                'photography' => 0.15,
                'catering' => 0.40,
                'decor' => 0.25,
                'others' => 0.20,
            ],

            default => [
                'photography' => 0.20,
                'catering' => 0.50,
                'decor' => 0.20,
                'others' => 0.10,
            ],
        };
    }
}

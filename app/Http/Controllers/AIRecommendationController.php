<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class AIRecommendationController extends Controller
{
    public function recommend(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:1'
        ]);

        $budget = $request->budget;

        $suppliers = Supplier::where('is_available', true)->get();

        $ranked = $suppliers->map(function ($supplier) use ($budget) {

            // 🎯 Budget match score
            $budgetScore = max(0, 100 - abs($budget - $supplier->price));

            // ⭐ Rating score
            $ratingScore = $supplier->rating * 20;

            // 💰 Within budget bonus
            $withinBudget = $supplier->price <= $budget ? 30 : 0;

            // 🤖 Final AI score
            $supplier->ai_score = $budgetScore + $ratingScore + $withinBudget;

            return $supplier;

        })->sortByDesc('ai_score');

        return view('client.result', [
            'suppliers' => $ranked,
            'budget' => $budget
        ]);
    }
}

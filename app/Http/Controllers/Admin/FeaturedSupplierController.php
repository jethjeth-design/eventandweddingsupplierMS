<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierProfile;

class FeaturedSupplierController extends Controller
{
    /**
     * Show all suppliers with featured toggle UI.
     */
    public function index()
    {
        $suppliers = SupplierProfile::with(['categories', 'ratings'])
            ->orderByDesc('is_featured')   // featured ones appear first
            ->orderBy('business_name')
            ->get();

        $featuredCount = $suppliers->where('is_featured', true)->count();
        $totalCount    = $suppliers->count();

        return view('admin.featured_supplier.index', compact(
            'suppliers',
            'featuredCount',
            'totalCount'
        ));
    }

    /**
     * Toggle the is_featured flag for a supplier.
     */
    public function toggle(SupplierProfile $supplierProfile)
{
    $supplierProfile->update([
        'is_featured' => ! $supplierProfile->is_featured,
    ]);

    $bizName = $supplierProfile->business_name
        ?? trim(($supplierProfile->first_name ?? '') . ' ' . ($supplierProfile->last_name ?? ''));

    $action = $supplierProfile->is_featured ? 'featured' : 'removed from featured';

    return redirect()
        ->route('featured-suppliers')
        ->with('success', "\"{$bizName}\" has been {$action} successfully.");
}
}
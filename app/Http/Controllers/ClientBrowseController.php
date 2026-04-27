<?php

namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use App\Models\SupplierPortfolio;
use App\Models\Package;
use App\Models\SupplierAvailability;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientBrowseController extends Controller
{
    // 🔎 LIST ALL SUPPLIERS
    public function index()
    {
        $suppliers = SupplierProfile::with('user')
            ->latest()
            ->get();

        return view('client.browse.index', compact('suppliers'));
    }

    // 👤 SINGLE SUPPLIER + PACKAGES
    public function show($id)
    {
    $supplier = SupplierProfile::with(['user'])
    ->findOrFail($id);

    $packages = Package::where('supplier_id', $supplier->id)
    ->with('inclusions')
    ->get();

    $events = Event::where('user_id', auth()->id())->get();

        return view('client.browse.show', compact('supplier', 'packages', 'events'));
    }

    public function portfolio($id)
    {
        $supplier = SupplierProfile::findOrFail($id);

    $portfolios = SupplierPortfolio::where('supplier_id', $supplier->id)
            ->latest()
            ->get();

        return view('client.browse.portfolio', compact('supplier', 'portfolios'));
    }


}



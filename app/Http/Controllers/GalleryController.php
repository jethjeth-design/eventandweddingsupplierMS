<?php

namespace App\Http\Controllers;
use App\Models\SupplierPortfolio;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $portfolios = SupplierPortfolio::where('supplier_id', auth()->id())->get();
        return view('supplier.portfolio.gallery', compact('portfolios'));
    }
}

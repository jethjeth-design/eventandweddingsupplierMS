<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->get();
        $categories    = Category::all();

        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create($validated);

        return redirect()
            ->route('subcategories.list')
            ->with('success', 'Subcategory created successfully.');
    }

    // ✅ FIXED FOR MODAL (uses ID, not model binding)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = Subcategory::findOrFail($id);

        $subcategory->update($validated);

        return redirect()
            ->route('subcategories.list')
            ->with('success', 'Subcategory updated successfully.');
    }

    // ✅ ALSO FIXED
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()
            ->route('subcategories.list')
            ->with('success', 'Subcategory deleted successfully.');
    }
}
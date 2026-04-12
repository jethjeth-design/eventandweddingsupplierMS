<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);

        // Ensure unique slug
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count) {
            $slug = "{$slug}-{$count}";
        }

        Category::create($request->only('name', 'slug', 'description'));

        return redirect()->route('admin.categories.list')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);

            // Ensure unique slug (exclude current category)
            $count = Category::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $category->id)
                ->count();

            if ($count) {
                $slug = "{$slug}-{$count}";
            }

        $category->update($request->only('name', 'slug', 'description'));

        return redirect()->route('admin.categories.list')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.list')->with('success', 'Category deleted successfully.');
    }
}

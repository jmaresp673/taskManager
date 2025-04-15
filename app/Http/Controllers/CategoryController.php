<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->orderBy('position')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color_code' => 'required',
            'description' => 'required',
        ]);

        Category::create($request->all());
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Reorder the categories by updating the position field
     */
    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Category::where('id', $id)->update(['position' => $index + 1]);
        }

        return response()->json(['message' => 'Position updated successfully.']);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'color_code' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($request->all());
        return redirect('/categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted successfully.');
    }
}

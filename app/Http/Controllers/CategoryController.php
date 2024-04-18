<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Fetch only valid categories
        $categories = Category::where('is_valid', true)->with('posts')->get();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image_url' => 'nullable|url',
            'description' => 'nullable',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(12);
        return view('categories.show', compact('category', 'posts'));
    }
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'image_url' => 'nullable|url',
            'description' => 'nullable',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function autocompleteCategories(Request $request)
    {
        $term = $request->input('term');
        $categories = Category::where('name', 'LIKE', '%' . $term . '%')->pluck('name');
        return response()->json($categories);
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

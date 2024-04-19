<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|max:2048', // Adjust the max file size as needed
            'description' => 'nullable',
        ]);

        // Créer une nouvelle catégorie avec is_valid=true
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->is_valid = true; // Ajoute cette ligne pour définir is_valid=true
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/imgCategories');
            $category->image_url = Storage::url($imagePath);
        }
        $category->save();

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
            'image' => 'nullable|image|max:2048', // Adjust the max file size as needed
            'description' => 'nullable',
        ]);

        // Mettre à jour les champs de la catégorie
        $category->name = $request->name;
        $category->description = $request->description;

        // Si une nouvelle image est fournie, la sauvegarder et mettre à jour l'URL de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($category->image_url) {
                Storage::delete(str_replace('storage', 'public', $category->image_url));
            }
            $imagePath = $request->file('image')->store('public/uploads/imgCategories');
            $category->image_url = Storage::url($imagePath);
        }

        // Sauvegarder les modifications de la catégorie
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function autocompleteCategories(Request $request)
    {
        $term = $request->input('term');
        $categories = Category::where('name', 'LIKE', '%' . $term . '%')
                            ->where('is_valid', true)
                            ->pluck('name');
        return response()->json($categories);
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
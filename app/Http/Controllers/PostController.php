<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(12);
        return view('posts.index', compact('posts'));
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();

        $description = '';
        $categories = collect();
        if ($request->has('description')) {
            preg_match_all('/#(\w+)/', $request->description, $matches);
            $categories = collect($matches[1])->unique();
            $description = $categories->implode(' ');
        }
        $post->description = $description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/imgPosts', 'public');
            $post->image_url = Storage::url($imagePath);
        }

        $post->save();

        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName], ['is_valid' => false]);
            $post->categories()->attach($category);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function myPosts()
    {
        $myPosts = Post::where('user_id', Auth::id())->latest()->get();
        return view('posts.my_posts', compact('myPosts'));
    }

    public function edit(Post $post)
    {
        if (Auth::id() == $post->user_id || Auth::user()->isAdmin()) {
            return view('posts.edit', compact('post'));
        } else {
            return redirect()->route('posts.index')->with('error', 'Vous n\'êtes pas autorisé à éditer ce post.');
        }
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        $description = '';
        $categories = collect();
        if ($request->has('description')) {
            preg_match_all('/#(\w+)/', $request->description, $matches);
            $categories = collect($matches[1])->unique();
            $description = $categories->implode(' ');
        }
        $post->description = $description;

        if ($request->hasFile('image')) {
            if ($post->image_url) {
                $oldImagePath = str_replace('/storage/', '', $post->image_url);
                Storage::disk('public')->move($oldImagePath, 'uploads/trash/' . basename($oldImagePath));
            }

            $newImagePath = $request->file('image')->store('uploads/imgPosts', 'public');
            $post->image_url = Storage::url($newImagePath);
        }

        $post->save();

        $post->categories()->sync([]);
        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName], ['is_valid' => false]);
            $post->categories()->attach($category);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id == $request->user()->id || $request->user()->isAdmin()) {
            if ($post->image_url) {
                $imagePath = str_replace('/storage/', '', $post->image_url);
                Storage::disk('public')->move($imagePath, 'uploads/trash/' . basename($imagePath));
            }
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        } else {
            return redirect()->route('posts.index')->with('error', 'Not authorized to delete this post.');
        }
    }
}

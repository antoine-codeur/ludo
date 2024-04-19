<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // Récupérer tous les posts et les trier par date de création
        $posts = Post::latest()->paginate(12);
        return view('posts.index', compact('posts')); // Assurez-vous que le nom de la vue est correct
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
        ]);

        // Analyser la description pour les hashtags
        $description = '';
        $categories = collect();

        // Vérifier si une description est fournie
        if ($request->has('description')) {
            // Analyser la description pour les hashtags
            preg_match_all('/#(\w+)/', $request->description, $matches);

            // Récupérer uniquement les noms des catégories
            $categories = collect($matches[1])->unique();

            // Construire la chaîne de description
            $description = $categories->implode(' ');
        }

        // Créer le post avec les données validées et attribuer l'ID de l'utilisateur actuel
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->description = $description;
        $post->user_id = Auth::id(); // Utilisateur actuellement connecté
        $post->save();

        // Créer les catégories manquantes
        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName], ['is_valid' => false]);
            $post->categories()->attach($category);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    public function myPosts()
    {
        $myPosts = Post::where('user_id', Auth::id())->latest()->get();
        return view('posts.my_posts', compact('myPosts')); // Notez le 'posts.' devant 'my_posts'
    }
    public function edit(Post $post)
    {
        if (Auth::id() == $post->user_id || Auth::user()->isAdmin()) {
            return view('posts.edit', compact('post'));
        } else {
            return redirect()->route('posts.index')->with('error', 'Vous n\'êtes pas autorisé à éditer ce post.');
        }
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id == $request->user()->id || $request->user()->isAdmin()) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        } else {
            return redirect()->route('posts.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce post.');
        }
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'nullable',
            'image_url' => 'nullable|url',
        ]);

        // Analyser la description pour les hashtags
        $description = '';
        $categories = collect();

        if ($request->has('description')) {
            preg_match_all('/#(\w+)/', $request->description, $matches);
            $categories = collect($matches[1])->unique();
            $description = $categories->implode(' ');
        }

        // Mettre à jour le post
        $post->title = $request->title;
        $post->content = $request->content;
        $post->description = $description;
        $post->save();

        // Mettre à jour les catégories associées
        $post->categories()->sync([]);
        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName], ['is_valid' => false]);
            $post->categories()->attach($category);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
}

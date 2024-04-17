<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;

class CategoryPostSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        $categories = Category::all();

        $posts->each(function ($post) use ($categories) {
            // Utilisation de syncWithoutDetaching pour éviter les doublons
            $post->categories()->syncWithoutDetaching(
                $categories->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}

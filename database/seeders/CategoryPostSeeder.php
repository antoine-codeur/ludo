<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;

class CategoryPostSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all posts and categories
        $posts = Post::all();
        $categories = Category::all();

        // Attach categories to each post randomly
        $posts->each(function ($post) use ($categories) {
            $post->categories()->attach(
                $categories->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}

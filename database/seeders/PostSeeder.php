<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::factory(50)->create()->each(function ($post) {
            $tags = explode(' ', $post->description);
            foreach ($tags as $tag) {
                $tag = trim($tag, '#');
                $category = Category::firstOrCreate(
                    ['name' => $tag],
                    ['is_valid' => true]
                );

                $post->categories()->attach($category->id);
            }
        });
    }
}

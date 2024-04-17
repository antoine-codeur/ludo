<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $posts = \App\Models\Post::all();

        foreach ($posts as $post) {
            \App\Models\Comment::factory(rand(0, 2))->create([
                'post_id' => $post->id,
                'user_id' => \App\Models\User::inRandomOrder()->first()->id
            ]);
        }
    }
}

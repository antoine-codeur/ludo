<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Post::factory(50)->create();  // Créer 50 posts
    }
}

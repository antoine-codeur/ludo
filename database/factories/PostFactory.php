<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class PostFactory extends Factory
{
    public function definition()
    {
        $categoryNames = Category::pluck('name')->all();
        
        // Sélectionnez un nombre aléatoire de catégories et formez une chaîne de tags.
        $tags = collect($categoryNames)->random(rand(1, min(6, count($categoryNames))))->implode(' ');

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'description' => $tags,
            'image_url' => $this->faker->imageUrl(),
            'approved' => $this->faker->boolean
        ];
    }
}

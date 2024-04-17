<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'description' => $this->faker->text,
            'image_url' => $this->faker->imageUrl(),
            'approved' => $this->faker->boolean
        ];
    }
}

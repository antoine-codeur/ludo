<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'description' => $this->faker->text
        ];
    }
}

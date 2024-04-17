<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'description' => $this->faker->sentence,
            'is_valid' => $this->faker->boolean(90)
        ];
    }
}

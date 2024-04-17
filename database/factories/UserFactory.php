<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected static ?string $password;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'last_username_update' => $this->faker->dateTimeThisYear,
            'username_id' => $this->faker->unique()->md5,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Utilisez bcrypt pour hasher le mot de passe
            'profile_picture' => $this->faker->imageUrl(),
            'role' => $this->faker->randomElement(['admin', 'user'])
        ];
    }
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

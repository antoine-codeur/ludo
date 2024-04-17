<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Specific real-world categories
        $categories = [
            ['name' => 'cuisine', 'is_valid' => true, 'image_url' => 'https://example.com/images/cuisine.jpg'],
            ['name' => 'education', 'is_valid' => true, 'image_url' => 'https://example.com/images/education.jpg'],
            ['name' => 'histoire', 'is_valid' => true, 'image_url' => 'https://example.com/images/histoire.jpg'],
            ['name' => 'culture', 'is_valid' => true, 'image_url' => 'https://example.com/images/culture.jpg'],
            ['name' => 'technologie', 'is_valid' => true, 'image_url' => 'https://example.com/images/technologie.jpg'],
            ['name' => 'sport', 'is_valid' => true, 'image_url' => 'https://example.com/images/sport.jpg'],
            ['name' => 'santé', 'is_valid' => true, 'image_url' => 'https://example.com/images/sante.jpg'],
            ['name' => 'musique', 'is_valid' => true, 'image_url' => 'https://example.com/images/musique.jpg'],
            ['name' => 'voyage', 'is_valid' => true, 'image_url' => 'https://example.com/images/voyage.jpg'],
            ['name' => 'mode', 'is_valid' => true, 'image_url' => 'https://example.com/images/mode.jpg'],
            ['name' => 'fantaisie', 'is_valid' => false, 'image_url' => 'https://example.com/images/fantaisie.jpg'],
            ['name' => 'mythes', 'is_valid' => false, 'image_url' => 'https://example.com/images/mythes.jpg']
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'is_valid' => $category['is_valid'],
                'image_url' => $category['image_url'],
                'description' => null  // You can add descriptions if needed
            ]);
        }
        // additionnal
        Category::factory(8)->create();  // Creates 8 valid categories
        Category::factory()->count(2)->create(['is_valid' => false]);  // Creates 2 invalid categories
    }
}

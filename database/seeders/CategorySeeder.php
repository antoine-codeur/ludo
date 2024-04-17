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
            ['name' => 'Cuisine', 'is_valid' => true, 'image_url' => 'https://example.com/images/cuisine.jpg'],
            ['name' => 'Éducation', 'is_valid' => true, 'image_url' => 'https://example.com/images/education.jpg'],
            ['name' => 'Histoire', 'is_valid' => true, 'image_url' => 'https://example.com/images/histoire.jpg'],
            ['name' => 'Culture', 'is_valid' => true, 'image_url' => 'https://example.com/images/culture.jpg'],
            ['name' => 'Technologie', 'is_valid' => true, 'image_url' => 'https://example.com/images/technologie.jpg'],
            ['name' => 'Sport', 'is_valid' => true, 'image_url' => 'https://example.com/images/sport.jpg'],
            ['name' => 'Santé', 'is_valid' => true, 'image_url' => 'https://example.com/images/sante.jpg'],
            ['name' => 'Musique', 'is_valid' => true, 'image_url' => 'https://example.com/images/musique.jpg'],
            ['name' => 'Voyage', 'is_valid' => true, 'image_url' => 'https://example.com/images/voyage.jpg'],
            ['name' => 'Mode', 'is_valid' => true, 'image_url' => 'https://example.com/images/mode.jpg'],
            ['name' => 'Fantaisie', 'is_valid' => false, 'image_url' => 'https://example.com/images/fantaisie.jpg'],
            ['name' => 'Mythes', 'is_valid' => false, 'image_url' => 'https://example.com/images/mythes.jpg']
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'is_valid' => $category['is_valid'],
                'image_url' => $category['image_url'],
                'description' => null  // You can add descriptions if needed
            ]);
        }

        // Additional categories generated via factory
        // Assuming you still want to create some additional generic categories
        Category::factory(8)->create();  // Creates 8 valid categories
        Category::factory()->count(2)->create(['is_valid' => false]);  // Creates 2 invalid categories
    }
}

<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Category; // ⚠️ Ensure Category Model is imported
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class; // ⚠️ Set model properly

    public function definition(): array
    {
        $title = $this->faker->sentence(3); // Generate a random title
        
        return [
            'title' => $title,
            'slug' => Str::slug($title), // Generate slug from title
            'description' => $this->faker->paragraph(), // Random description
            'status' => $this->faker->randomElement(['active', 'inactive']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

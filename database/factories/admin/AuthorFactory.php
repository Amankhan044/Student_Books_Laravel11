<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Author; // ⚠️ Ensure Author Model is imported
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Author>
 */
class AuthorFactory extends Factory
{
    protected $model = Author::class; // ⚠️ Set model properly

    public function definition(): array
    {
        $title = $this->faker->name(); // Generate a random name
        
        return [
            'title' => $title,
            'slug' => Str::slug($title), // Generate slug from title
            'designation' => $this->faker->jobTitle(), // Random job title
            'dob' => $this->faker->date(), // Random date of birth
            'country' => $this->faker->country(), // Random country
            'email' => $this->faker->unique()->safeEmail(), // Unique email
            'phone' => $this->faker->phoneNumber(), // Random phone number
            'description' => $this->faker->paragraph(), // Random description
            'author_feature' => $this->faker->sentence(), // Random feature text
            'facebook_id' => 'https://facebook.com/' . Str::random(10), // Random FB ID
            'twitter_id' => 'https://twitter.com/' . Str::random(10), // Random Twitter ID
            'youtube_id' => 'https://youtube.com/' . Str::random(10), // Random YouTube ID
            'pinterest_id' => 'https://pinterest.com/' . Str::random(10), // Random Pinterest ID
            'author_img' => $this->faker->imageUrl(200, 200, 'people'), // Random author image
            'status' => $this->faker->randomElement(['active', 'inactive']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

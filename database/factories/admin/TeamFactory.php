<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin\Team;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'fullname' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'telephone' => $this->faker->phoneNumber(),
            'mobile' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'facebook_id' => 'https://facebook.com/' . $this->faker->userName(),
            'twitter_id' => 'https://twitter.com/' . $this->faker->userName(),
            'pinterest_id' => 'https://pinterest.com/' . $this->faker->userName(),
            'profile' => $this->faker->paragraph(),
            'team_img' => $this->faker->imageUrl(200, 200, 'people'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

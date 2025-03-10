<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Book;
use App\Models\Admin\Category;
use App\Models\Admin\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(), // Ensure category exists
            'author_id' => Author::inRandomOrder()->first()->id ?? Author::factory(), // Ensure author exists
            'title' => $title,
            'slug' => Str::slug($title),
            'availability' => $this->faker->randomElement(['in stock', 'out of stock']),
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'publisher' => $this->faker->company(),
            'country_of_publisher' => $this->faker->country(),
            'isbn' => $this->faker->isbn13(),
            'isbn_10' => $this->faker->isbn10(),
            'audience' => $this->faker->randomElement(['General', 'Children', 'Academic']),
            'format' => $this->faker->randomElement(['Hardcover', 'Paperback', 'eBook']),
            'language' => $this->faker->languageCode(),
            'total_pages' => $this->faker->numberBetween(50, 1000),
            'downloaded' => $this->faker->numberBetween(0, 10000),
            'edition_number' => $this->faker->randomDigitNotNull(),
            'recommended' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'book_img' => null,
            'book_upload' => 'books/sample.pdf', // Dummy file path
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

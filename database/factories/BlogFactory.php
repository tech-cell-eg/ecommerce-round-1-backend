<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'slug' => fake()->url(),
            'content' => fake()->text(),
            'author_id' => 1,
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'featured_image' => fake()->image(),
            'tags' => 'Tag1',
            'category' => fake()->randomElement(['Clothes', 'Scarf', 'Accessories']),
            'published_at' => fake()->dateTime()
        ];
    }
}

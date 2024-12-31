<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "msg" => fake()->paragraph(),
            "stars" => fake()->numberBetween(1, 5),
            "product_id" => Product::first()->id,
            "name" => fake()->name(),
            "email" => fake()->email()
        ];
    }
}

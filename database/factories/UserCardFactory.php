<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCard>
 */
class UserCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory()->create()->id,
            "card_name" => fake()->name(),
            "card_number" => fake()->creditCardNumber(),
            "card_expiry_date" => fake()->creditCardExpirationDate(),
            "card_cvv" => '123',
        ];
    }
}

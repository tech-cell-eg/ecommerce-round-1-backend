<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'user_address_id' => UserAddress::factory()->create()->id,
            'user_card_id' => UserCard::factory()->create()->id,
            'status' => fake()->randomElement(['in process', 'delivered', 'cancelled']),
            'delivery_date' => fake()->dateTimeBetween('now', '+2 months')->format('d-M-Y'),
            'discount_code' => fake()->randomElement(['discount code 1', null]),
            'delivery_charge' => fake()->randomElement(['10', '20']),
            'grand_total' => fake()->randomDigitNotZero(),
            'review' => fake()->paragraph(2),
        ];
    }
}

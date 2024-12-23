<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
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
            'name' => fake()->name(),
            'mobile_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'area' => fake()->city(),
            'pin_code' => fake()->postcode(),
            'city' => fake()->city(),
            'state' => fake()->city(),
            'default_address' => fake()->randomElement([true, false]),
        ];
    }
}

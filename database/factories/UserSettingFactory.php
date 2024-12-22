<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSetting>
 */
class UserSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'language' => 'en',
            'appearance' => 'light',
            'two_factor_authentication' => fake()->boolean(0),
            'push_notifications' => fake()->boolean(100),
            'desktop_notification' => fake()->boolean(100),
            'email_notifications' => fake()->boolean(100),
        ];
    }
}

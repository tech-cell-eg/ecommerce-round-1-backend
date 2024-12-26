<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OurStory>
 */
class OurStoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "image" => UploadedFile::fake()->image('testImage1.jpg'),
            "title" => fake()->words(3, true),
            "description" => fake()->paragraph(10)
        ];
    }
}

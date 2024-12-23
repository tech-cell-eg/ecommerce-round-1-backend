<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // becouse testimonial depend on product
        Product::factory()->create();
        Testimonial::insert([
            'user_id'    => 1,
            'product_id' => 1,
            'text' => $faker->sentence(),
            'image'      => $faker->imageUrl(),
            'video'      => 'videos/testimonials/dummy-video-1.mp4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
    }
}

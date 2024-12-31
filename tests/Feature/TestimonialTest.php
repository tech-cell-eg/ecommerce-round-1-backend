<?php

use App\Models\Testimonial;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_store_new_testimonial()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);
        
        $product = Product::create([
            'name' => 'New Product',
            'description' => 'New Product lalala',
            'price' => 100,
            'compare_price' => 100,
            'rating' => 2,
            'featured' => 0
            
        ]);

        $testimonial = [
            'product_id' => $product->id,
            // 'user_id' => $user->id,
            'text' => 'testimonial',
        ];

        $response = $this->actingAs($user)->postJson('/api/testimonials', $testimonial);
        $response->assertStatus(201);
    }

    public function user_can_show_all_testimonials()
    {
        $response = $this->getJson('/api/testimonials');
        $response->assertStatus(200);
    }

    public function user_can_update_testimonial()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);
        
        $product = Product::create([
            'name' => 'New Product',
            'description' => 'New Product lalala',
            'price' => 100,
            'compare_price' => 100,
            'rating' => 2,
            'featured' => 0
            
        ]);

        $testimonial = [
            'product_id' => $product->id,
            'text' => 'testimonial',
        ];

        $response = $this->actingAs($user)->postJson('/api/testimonials', $testimonial);

        $testimonialId = $response->json('data.id');

        $updatedDate = [
            'product_id' => $product->id,
            'text' => 'updated testimonial text'
        ];

        $response = $this->actingAs($user)->putJson("/api/testimonials/$testimonialId", $updatedDate);
        $response->assertStatus(200);
    }

    public function user_can_delete_testimonial()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);
        
        $product = Product::create([
            'name' => 'New Product',
            'description' => 'New Product lalala',
            'price' => 100,
            'compare_price' => 100,
            'rating' => 2,
            'featured' => 0
            
        ]);

        $testimonial = [
            'product_id' => $product->id,
            'text' => 'testimonial',
        ];

        $response = $this->actingAs($user)->postJson('/api/testimonials', $testimonial);

        $testimonialId = $response->json('data.id');

        $response = $this->actingAs($user)->deleteJson("/api/testimonials/$testimonialId");
        $response->assertStatus(200);
    }

}



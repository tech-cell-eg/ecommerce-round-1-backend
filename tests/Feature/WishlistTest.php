<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_add_wishlist_product()
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

        $response = $this->actingAs($user)->postJson('/api/wish-list', ['product_id' => $product->id]);

        $response->assertStatus(201);
    }

    /** @test */
    public function user_can_show_all_wishlist_products()
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

        $response = $this->actingAs($user)->postJson('/api/wish-list', ['product_id' => $product->id]);

        $wishlistId = $response->json('id');

        $response = $this->actingAs($user)->getJson("/api/wish-list/{$wishlistId}");

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_remove_wishlist_product()
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

        $response = $this->actingAs($user)->postJson('/api/wish-list', ['product_id' => $product->id]);

        $wishlistId = $response->json('id');

        $response = $this->actingAs($user)->deleteJson("/api/wish-list/{$product->id}");

        $response->assertStatus(200);
    }

    

    
}

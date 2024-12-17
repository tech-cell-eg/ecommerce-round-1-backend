<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase{
    public function test_index_retrieves_favorites()
    {
        // Create a user
        $user = new User();
        $user->first_name = 'Test';
        $user->last_name='User';
        $user->email = 'test.user@example.com';
        $user->password = bcrypt('password');
        $user->save();

        // Authenticate the user
        $this->actingAs($user);


        // Create products
        $product = new Product();
        $product->name = 'Product 1';
        $product->price = 100;
        $product->save();

        Favorite::create(['user_id' => $user->id, 'product_id' => $product->id]);

        $response = $this->get('/api/favorites');
        $response->assertStatus(200)
        ->assertJsonCount(1)
        ->assertJsonFragment(['product_id' => $product->id]);

    }
}



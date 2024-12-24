<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;
    function setUp(): void
    {
        TestCase::setUp();
        Model::unsetEventDispatcher();
    }
    public function test_index_retrieves_favorites()
    {
        // Create a user
        $user = User::factory()->create();

        // Create products using the factory
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        // Add products to the user's favorites
        Favorite::create(['user_id' => $user->id, 'product_id' => $product1->id]);
        Favorite::create(['user_id' => $user->id, 'product_id' => $product2->id]);

        // Act as the user
        $this->actingAs($user);

        // Call the index method
        $response = $this->getJson('api/favorites');

        // Assert the response contains the expected favorites
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'product' => ['id', 'name', 'price', 'image']],
            ])
            // Ensure that product IDs are part of the response
            ->assertJsonFragment(['id' => $product1->id])
            ->assertJsonFragment(['id' => $product2->id]);
    }


    public function test_store_creates_favorite()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('api/favorites', [
            'product_id' => $product->id,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product added to favorites']);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }







}

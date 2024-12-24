<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;


    function setUp(): void
    {
        TestCase::setUp();
        Cart::unsetEventDispatcher();
    }

    private function createCart()
    {
        $user = User::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $cart = Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
        return $outputs = [
            'cart' => $cart,
            'user' => $user,
        ];
    }

    function test_cart_api_returns_valid_data()
    {
        $outputs = $this->createCart();
        $response = $this->actingAs($outputs['user'])->getJson("/api/cart");

        $response->assertStatus(200);
        $response->assertJson(["data" => [$outputs['cart']->toArray()]]);
    }

    function test_cart_api_returns_invalid_error()
    {
        $response = $this->getJson("/api/cart");

        $response->assertStatus(401);
    }

    function test_cart_store_api_returns_successful_message()
    {
        $outputs = $this->createCart();
        $response = $this->actingAs($outputs['user'])
            ->postJson("/api/cart", [
                "product_id" => "1",
                "quantity" => "5"
            ]);

        $response->assertStatus(200);
        $response->assertJson(["message" => "item has been added successfully!"]);
    }

    // function test_cart_store_api_can_create_or_update() {
    //      $outputs = $this->createCart();
    //     $response = $this->actingAs($outputs['user'])
    //     ->postJson("/api/cart", [
    //         "product_id" => "1",
    //         "quantity" => "2"
    //     ]);

    //     $newData = [
    //         "product_id" => "1",
    //         "quantity" => "5"
    //     ];
    //     $response = $this->actingAs($outputs['user'])
    //     ->postJson("/api/cart", $newData);

    //     $response->assertStatus(200);
    //     $this->assertDatabaseCount("carts", 1);
    //     $this->assertDatabaseHas("carts", $newData);
    // }

    function test_cart_store_api_add_data_in_database()
    {
        $outputs = $this->createCart();
        $this->actingAs($outputs['user'])
            ->postJson("/api/cart", ["product_id" => 1]);

        $this->assertDatabaseCount("carts", 1);
    }

    function test_cart_update_api_returns_successful_message()
    {
        $outputs = $this->createCart();
        $response = $this->actingAs($outputs['user'])
            ->putJson("/api/cart/" . $outputs['cart']->id, []);

        $response->assertStatus(200);
        $response->assertJson(["message" => "item has been updated successfully!"]);
    }

    function test_cart_update_api_can_update_only_quantity()
    {
        $outputs = $this->createCart();
        $response = $this->actingAs($outputs['user'])
            ->putJson("/api/cart/" . $outputs['cart']->id, [
                "product_id" => 2
            ]);

        $response->assertStatus(200);
        $this->assertEquals($outputs['cart']->product_id, Cart::find(1)->product_id);
    }

    function test_cart_delete_api_returns_successful_message()
    {
        $outputs = $this->createCart();

        $response = $this->actingAs($outputs['user'])
            ->deleteJson("/api/cart/" . $outputs['cart']->id);

        $response->assertStatus(200);
        $response->assertJson(["message" => "item has been deleted successfully!"]);
    }


}

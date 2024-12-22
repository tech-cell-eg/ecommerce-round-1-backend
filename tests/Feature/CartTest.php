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
    private $user;
    private $cart;

    function setUp() : void 
    {
        TestCase::setUp();
        $this->user = User::factory()->create();
        Category::factory()->create();
        Product::factory()->create();
        $this->cart = Cart::factory()->create();
    }
    
    function test_cart_api_returns_valid_data() {
        $response = $this->actingAs($this->user)->getJson("/api/cart");

        $response->assertStatus(200);
        $response->assertJson(["data" => [$this->cart->toArray()]]);
    }

    function test_cart_api_returns_invalid_error() {
        $response = $this->getJson("/api/cart");

        $response->assertStatus(401);
    }

    function test_cart_store_api_returns_successful_message() {
        $response = $this->actingAs($this->user)
        ->postJson("/api/cart", [
            "product_id" => "1",
            "quantity" => "5"
        ]);

        $response->assertStatus(200);
        $response->assertJson(["message" => "item has been added successfully!"]);
    }

    // function test_cart_store_api_can_create_or_update() {
    //     $response = $this->actingAs($this->user)
    //     ->postJson("/api/cart", [
    //         "product_id" => "1",
    //         "quantity" => "2"
    //     ]);

    //     $newData = [
    //         "product_id" => "1",
    //         "quantity" => "5"
    //     ];
    //     $response = $this->actingAs($this->user)
    //     ->postJson("/api/cart", $newData);

    //     $response->assertStatus(200);
    //     $this->assertDatabaseCount("carts", 1);
    //     $this->assertDatabaseHas("carts", $newData);
    // }

    function test_cart_store_api_add_data_in_database() {
        $this->actingAs($this->user)
        ->postJson("/api/cart", ["product_id" => 1]);

        $this->assertDatabaseCount("carts", 1);
    }

    function test_cart_update_api_returns_successful_message() {
        $response = $this->actingAs($this->user)
        ->putJson("/api/cart/". $this->cart->id, []);

        $response->assertStatus(200);
        $response->assertJson(["message" => "item has been updated successfully!"]);
    }

    function test_cart_update_api_can_update_only_quantity() {
        $response = $this->actingAs($this->user)
        ->putJson("/api/cart/". $this->cart->id, [
            "product_id" => 2
        ]);

        $response->assertStatus(200);
        $this->assertEquals($this->cart->product_id, Cart::find(1)->product_id);
    }

    function test_cart_delete_api_returns_successful_message() {
        $response = $this->actingAs($this->user)
        ->deleteJson("/api/cart/".$this->cart->id);

        $response->assertStatus(200);
        $response->assertJson(["message" => "item has been deleted successfully!"]);
    }


}

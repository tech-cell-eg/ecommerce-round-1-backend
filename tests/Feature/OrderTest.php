<?php


use App\Models\PasswordResetToken;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): array
    {
        $user = User::factory()->create();
        $card = UserCard::factory()->create(['user_id' => $user->id]);
        $address = UserAddress::factory()->create(['user_id' => $user->id]);
        $products = Product::factory(4)->create();
        return [
            'user' => $user,
            'card' => $card,
            'address' => $address,
            'products' => $products
        ];
    }

    public function test_a_user_can_create_an_order()
    {
        //Arrange
        $outputs = $this->createUser();
        //Act
        $response = $this->actingAs($outputs['user'])->postJson('/api/orders', [
            'user_address_id' => $outputs['address']->id,
            'user_card_id' => $outputs['card']->id,
            'discount_code' => 'discount_code',
            'products' => [$outputs['products'][0]->id, $outputs['products'][1]->id, $outputs['products'][2]->id],
            'quantities' => [1, 1, 1],
            'sizes' => ['S', 'M', 'L'],
        ]);
        //Assert
        $response->assertStatus(200)->assertJson([
            "status" => 200,
            "message" => "Order created successfully."
        ]);
        $this->assertDatabaseHas('orders', [
            'user_id' => $outputs['user']->id,
            'user_address_id' => $outputs['address']->id,
            'user_card_id' => $outputs['card']->id,
        ]);
    }

    public function test_a_user_can_not_create_an_order_without_being_authenticated()
    {
        //Arrange
        $outputs = $this->createUser();
        //Act
        $response = $this->postJson('/api/orders', [
            'user_address_id' => $outputs['address']->id,
            'user_card_id' => $outputs['card']->id,
            'discount_code' => 'discount_code',
            'products' => [$outputs['products'][0]->id, $outputs['products'][1]->id, $outputs['products'][2]->id],
            'quantities' => [1, 1, 1],
            'sizes' => ['S', 'M', 'L'],
        ]);
        //Assert
        $response->assertStatus(401)->assertJson([
            "message" => "Unauthenticated."
        ]);
    }

    public function test_a_user_can_not_create_an_order_with_an_address_that_does_not_belong_to_the_user()
    {
        //Arrange
        $outputs = $this->createUser();
        $address = UserAddress::factory()->create();
        //Act
        $response = $this->actingAs($outputs['user'])->postJson('/api/orders', [
            'user_address_id' => $address->id,
            'user_card_id' => $outputs['card']->id,
            'discount_code' => 'discount_code',
            'products' => [$outputs['products'][0]->id, $outputs['products'][1]->id, $outputs['products'][2]->id],
            'quantities' => [1, 1, 1],
            'sizes' => ['S', 'M', 'L'],
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            "message" => "This address id does not exist."
        ]);
    }

    public function test_a_user_can_noy_create_an_order_with_an_card_that_does_not_belong_to_the_user()
    {
        //Arrange
        $outputs = $this->createUser();
        $card = UserCard::factory()->create();
        //Act
        $response = $this->actingAs($outputs['user'])->postJson('/api/orders', [
            'user_address_id' => $outputs['address']->id,
            'user_card_id' => $card->id,
            'discount_code' => 'discount_code',
            'products' => [$outputs['products'][0]->id, $outputs['products'][1]->id, $outputs['products'][2]->id],
            'quantities' => [1, 1, 1],
            'sizes' => ['S', 'M', 'L'],
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            "message" => "This card id does not exist."
        ]);
    }

    public function test_a_user_can_not_create_an_order_with_number_of_quantities_does_not_match_number_of_products()
    {
        //Arrange
        $outputs = $this->createUser();
        //Act
        $response = $this->actingAs($outputs['user'])->postJson('/api/orders', [
            'user_address_id' => $outputs['address']->id,
            'user_card_id' => $outputs['card']->id,
            'discount_code' => 'discount_code',
            'products' => [$outputs['products'][0]->id, $outputs['products'][1]->id, $outputs['products'][2]->id],
            'quantities' => [1],
            'sizes' => ['S', 'M', 'L'],
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            "message" => "The quantities field must have at least 3 items."
        ]);
    }

    public function test_a_user_can_not_create_an_order_with_number_of_sizes_does_not_match_number_of_products()
    {
        //Arrange
        $outputs = $this->createUser();
        //Act
        $response = $this->actingAs($outputs['user'])->postJson('/api/orders', [
            'user_address_id' => $outputs['address']->id,
            'user_card_id' => $outputs['card']->id,
            'discount_code' => 'discount_code',
            'products' => [$outputs['products'][0]->id, $outputs['products'][1]->id, $outputs['products'][2]->id],
            'quantities' => [1, 1, 1],
            'sizes' => ['S'],
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            "message" => "The sizes field must have at least 3 items."
        ]);
    }

}

<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    function setUp(): void
    {
        TestCase::setUp();
        Model::unsetEventDispatcher();
    }
    function createReview() {
        User::factory()->create();
        Category::factory()->create();
        Product::factory()->create();
        return Review::factory()->create();
    }

    public function test_api_reviews_returns_successful(): void
    {
        $response = $this->getJson("/api/reviews");

        $response->assertStatus(200);
    }

    public function test_api_reviews_returns_valid_data(): void
    {
        $review = $this->createReview();

        $response = $this->getJson("/api/reviews");

        $response->assertJson(["data" => [$review->toArray()]]);
    }

    public function test_api_reviews_store_successful(): void
    {
        $review = $this->createReview();

        $response = $this->postJson("/api/reviews", $review->toArray());

        $response->assertStatus(200);
        $response->assertJson(["message" => "review created successfully!"]);
    }

    public function test_api_reviews_store_add_to_database(): void 
    {
        $review = $this->createReview();

        $this->postJson("/api/reviews", $review->toArray());

        $this->assertDatabaseHas("reviews", $review->toArray());
    }

    public function test_api_reviews_store_returns_invalid_error(): void
    {
        $response = $this->postJson("/api/reviews", []);

        $response->assertStatus(422);
        $response->assertJsonCount(5, ["errors"]);
    }

    public function test_api_reviews_update_successful(): void
    {
        $review = $this->createReview();
        $review->msg = "test 123";

        $response = $this->putJson("/api/reviews/".$review->id, $review->toArray());

        $response->assertStatus(200);
        $response->assertJson(["message" => "review updated successfully!"]);
    }

    public function test_api_reviews_update_returns_invalid_error(): void
    {
        $review = $this->createReview();

        $response = $this->putJson("/api/reviews/". $review->id, []);

        $response->assertStatus(422);
        $response->assertJsonCount(5, ["errors"]);
    }

    public function test_api_delete_successful(): void
    {
        $review = $this->createReview();
        $response = $this->deleteJson("/api/reviews/" . $review->id);

        $response->assertStatus(200);
        $response->assertJson(["message" => "review deleted successfully!"]);
    }

    public function test_api_delete_remove_from_database(): void
    {
        $review = $this->createReview();
        $response = $this->deleteJson("/api/reviews/" . $review->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing("reviews", $review->toArray());
    }

    public function test_api_delete_returns_invalid_error(): void
    {
        $response = $this->deleteJson("/api/reviews/" . 1);

        $response->assertStatus(404);
    }
    
}

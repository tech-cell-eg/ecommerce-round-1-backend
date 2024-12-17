<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // iam using this becouse iam testing in sqlite database
    use RefreshDatabase;

    function test_api_returns_categories_list(): void
    {
        $category = Category::factory()->create();
        $response = $this->getJson('/api/categories');
        $response->assertStatus(200);
        $response->assertJson([ "data" => [$category->toArray()]]);
    }

    function test_api_category_show_return_valid_data() {
        $category = Category::factory()->create();

        $response = $this->getJson('/api/categories/'.$category->id);
        $response->assertStatus(200);
        $response->assertJson($category->toArray());
    }

    function test_api_category_show_contain_sub_categories() {
        $category = Category::factory()->create();
        SubCategory::create(["name" => "test", "category_id" => $category->id]);
        $category["sub-category"] = $category->sub->pluck("name")->toArray();
        
        $response = $this->getJson("/api/categories/".$category->id);

        $response->assertJson(["sub-category" => $category["sub-category"]]);
    }

    function test_api_category_store_successful() {
        $response = $this->postJson("/api/categories", [
            "name" => "test"
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            "message" => "category has been added successfully!"
        ]);
    }

    function test_api_category_store_return_invalied_error() {
        $response = $this->postJson("/api/categories", [
            "name" => ""
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The name field is required."
        ]);
    }
    
    function test_api_category_update_successful() {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/categories/".$category->id, [
            "name" => "something else"
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            "message" => "category has been updated successfully!"
        ]);
    }
    function test_api_category_update_return_invalied_error() {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/categories/".$category->id, [
            "name" => ""
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The name field is required."
        ]);
    }
    function test_api_category_delete_successful() {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/".$category->id);

        $response->assertStatus(200);
        $response->assertJson([
            "message" => "category has been deleted successfully!"
        ]);
    }
    function test_api_category_delete_return_invalied_error() {
        $response = $this->deleteJson("/api/categories/"."5");

        $response->assertStatus(404);
        $response->assertJson([
            "message" => "No query results for model [App\\Models\\Category] 5"
        ]);
    }



}

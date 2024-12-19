<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_Product_index(): void
    {

        $products = Product::factory()->count(3)->create();

        $response = $this->getJson('/api/product');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }


    public function test_Product_create(): void
    {


        // $this->assertDatabaseHas('products', $product);

        // // Check the API response to ensure it has the correct structure.
        // $response->assertJson(['data' => $product]);
        // Set up a fake filesystem
    Storage::fake('public');

    // Create a fake image file
    $imageFile = UploadedFile::fake()->image('image.jpg');

    // Prepare the data including the fake image
    $data = [
        'name' => 'New Product',
        'description' => 'Product description',
        'price' => 99.99,
        'image' => $imageFile, 
        'compare_price' => null,
        'rating' => 0, 
        'featured' => 0, 
        'category_id' => 1,
    ];

    // Post request to store the product
    $response = $this->postJson('/api/product', $data);

    // Assert response status and content
    $response->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'New Product',
        ]);

    // Assert that the product has been created in the database
    $this->assertDatabaseHas('products', [
        'name' => 'New Product',
        'description' => 'Product description',
        'price' => 99.99,
        'image' => 'uploads/' . $imageFile->hashName(),
        'compare_price' => null,
        'rating' => 0, 
        'featured' => 0, 
        'category_id' => 1, 
    ]);

    // Assert that the uploaded file is stored correctly
    Storage::disk('public')->assertExists('uploads/' . $imageFile->hashName());

    }


    public function test_Product_create_validation_fail()
    {
        // Send a request with missing required fields
        $response = $this->postJson('/api/product', []);

        // Assert validation error response
        $response->assertStatus(422) // Unprocessable Entity
            ->assertJsonValidationErrors(['name', 'price']);
    }

    public function test_Product_Show(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image' => $product->image,
                    'compare_price' => $product->compare_price,
                    'rating' => $product->rating,
                    'featured' => $product->featured,
                    'category' => [
                        'id' => $product->category->id,
                        'name' => $product->category->name,
                    ],
                    // Add more fields here to match your ProductResource
                ],
            ]);
    }




    public function test_Product_Search()
    {
        $product = Product::factory()->create(['name' => 'Searchable Product']);

        $response = $this->getJson('/api/products/search?query=Searchable');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'name' => 'Searchable Product',
            ]);
    }


    public function test_Product_Search_Fail()
    {
        $response = $this->json('GET', '/api/products/search', [
            'query' => 'NonExistentProduct' // Unlikely to have this product
        ]);

        // Assert the status and that the data is empty
        $response->assertStatus(200)->assertJson([]);
    }


    public function test_requires_query_when_searching()
    {
        // Attempt to search without the required parameter
        $response = $this->getJson('/api/products/search');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['query']);
    }
}

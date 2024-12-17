<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_Product_index(): void
    {
        $response = $this->get('/api/product');
        $response->assertStatus(200);
        $responseData = $response->json();
        foreach ($responseData['data'] as $product) {
            $this->assertDatabaseHas('products', [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'image' => $product['image'],
                'compare_price' => $product['compare_price'],
                'rating' => $product['rating'],
                'featured' => $product['featured']
            ]);
        }
    }


    public function test_Product_create(): void
    {
        $product = [
            'name' => 'test_product',
            'price' => 10,
            'compare_price' => 20,
            'description' => 'test description',
            'image' => 'test_image.png',
            'rating' => 5,
            'featured' => 1
        ];

        $response = $this->postJson('/api/product', $product);
        $response->assertStatus(201);

        // Check that the product was saved correctly in the database
        $this->assertDatabaseHas('products', $product);

        // Check the API response to ensure it has the correct structure.
        $response->assertJson(['data' => $product]);
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
        $productId = 11;
        $product = [
            'name' => 'test_product',
            'price' => 10,
            'compare_price' => 20,
            'description' => 'test description',
            'image' => 'test_image.png',
            'rating' => 5,
            'featured' => 1
        ];
        $response = $this->get('/api/product/' . $productId);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', $product);
    }




    public function test_Product_Search()
    {
        // Set up test data
        Product::create([
            'name' => 'Test Product',
            'description' => 'Description of the test product',
            'price' => 10,
            'compare_price' => 20,
            'image' => 'test_image.png',
            'rating' => 5,
            'featured' => 1,
        ]);

        // Execute the search request
        $response = $this->json('GET', '/api/products/search', [
            'query' => 'Test' // Searching for a product containing 'Test'
        ]);

        // Assert the status and response structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'compare_price',
                    'image',
                    'rating',
                    'featured',
                ]
            ])
            ->assertJsonFragment(['name' => 'Test Product']); // Ensure the correct product is returned
    }


    public function test_Product_Search_Fail()
    {
        $response = $this->json('GET', '/api/products/search', [
            'query' => 'NonExistentProduct' // Unlikely to have this product
        ]);

        // Assert the status and that the data is empty
        $response->assertStatus(200)->assertJson([]);
    }

}

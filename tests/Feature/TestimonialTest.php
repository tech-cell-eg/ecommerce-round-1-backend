<?php

use App\Models\Testimonial;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;


test('User can show all testimonials', function(){

    $response = $this->getJson('/api/testimonial');
    $response->assertStatus(200);
});

test('User can store a testimonial', function(){
    // $user = User::find(1);
    
    $faker = Faker::create();
    $data = [
        'product_id' => 1,
        'user_id' => 1,
        'text' => 'testimonial',
        // 'image' => 'images/testimonials/' . $faker->image('public/storage/', 640, 480),
        'image' => UploadedFile::fake()->image('testimonial.jpg', 640, 480),

    ];

    $response = $this->postJson('/api/testimonial', $data);
    $response->assertStatus(201);
});


test('User can update a testimonial', function(){
    $updatedDate = [
        'product_id' => 1,
        'text' => 'updated testimonial text'
    ];

    $response = $this->putJson('/api/testimonial{1}', $updatedDate);
    $response->assertStatus(200);
});

test('User can delete a testimonial', function(){

    $response = $this->deleteJson('/api/testimonial{1}');
    $response->assertStatus(200);
});




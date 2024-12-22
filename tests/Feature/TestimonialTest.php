<?php

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use Tests\TestCase;
class TestimonialTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_store_new_testimonial()
    {
        $user = User::find(1);

        $testimonial = [
            'product_id' => 1,
            'user_id' => 1,
            'text' => 'testimonial',
        ];

        $response = $this->postJson('/api/testimonial', $testimonial);
        $response->assertStatus(200);
    }

        /** @test */
    public function user_can_show_all_testimonials()
    {
        $response = $this->getJson('/api/testimonial/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_testimonial()
    {
        $testimonial = [
            'product_id' => 1,
            'user_id' => 1,
            'text' => 'testimonial',
        ];

        $this->postJson('/api/testimonial', $testimonial);

        $updatedDate = [
            'product_id' => 1,
            'text' => 'updated testimonial text'
        ];
    
        $response = $this->putJson('/api/testimonial/{1}', $updatedDate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_testimonial()
    {
        $testimonial = [
            'product_id' => 1,
            'user_id' => 1,
            'text' => 'testimonial',
        ];
        
        $this->postJson('/api/testimonial', $testimonial);

        $response = $this->deleteJson('/api/testimonial/{1}');
        $response->assertStatus(200);
    }

}



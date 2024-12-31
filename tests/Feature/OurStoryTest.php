<?php

namespace Tests\Feature;

use App\Models\OurStory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OurStoryTest extends TestCase
{
    // iam using this becouse iam testing in sqlite database
    use RefreshDatabase;

    function test_api_our_story_returns_data_successful() {
        $response = $this->getJson("/api/our-stories");

        $response->assertStatus(200);
    }

    function test_api_our_story_returns_valid_data() {
        $story = OurStory::factory()->create();

        $response = $this->getJson("/api/our-stories");

        $response->assertJson(["data" => [$story->toArray()]]);
    }
}

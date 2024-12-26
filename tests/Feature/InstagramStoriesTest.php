<?php

namespace Tests\Feature;

use App\Models\InstagramStories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstagramStoriesTest extends TestCase
{
    // iam using this becouse iam testing in sqlite database
    use RefreshDatabase;

    function test_api_insta_story_returns_data_successful() {
        $response = $this->getJson("/api/instagram-stories");

        $response->assertStatus(200);
    }

    function test_api_insta_story_returns_valid_data() {
        $story = InstagramStories::factory()->create();

        $response = $this->getJson("/api/instagram-stories");

        $response->assertJson(["data" => [$story->toArray()]]);
    }
}

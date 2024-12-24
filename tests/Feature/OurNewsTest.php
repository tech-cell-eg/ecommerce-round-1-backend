<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
class OurNewsTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_subscribe_to_our_news_returns_success(): void
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);

        $response = $this->actingAs($user)->postJson('/api/our-news', [
            'email' => $user->email
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'User subscribed to our news successfully.',
                 ]);
    }
}

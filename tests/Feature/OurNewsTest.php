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
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/ournews', [
            'email' => 'tester@gmail.com'
        ]);
        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'User subscribed to our news successfully.',
                 ]);
    }
}

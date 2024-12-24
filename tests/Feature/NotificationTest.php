<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_notification_create_when_user_register(): void
    {
        $response = $this->postJson("/api/register", [
            "first_name" => "abdo",
            "last_name" => "abdo",
            "email" => "a@a.a",
            "password" => "Aa12345678",
            "password_confirmation" => "Aa12345678",
            "terms_agreed" => "1"
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount("users", 1);
        $this->assertDatabaseCount("notifications", 1);
    }
}

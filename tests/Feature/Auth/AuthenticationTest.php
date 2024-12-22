<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin')
        ->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated('admin');
    }



    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $admin = Admin::factory()->create();

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin)->post('/logout');

        $this->assertGuest('admin');
        $response->assertRedirect('/');
    }
}

<?php

namespace Tests\Feature\API;

use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private static array $user = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@example.com',
        'password' => '12345678Aa',
        'terms_agreed' => true,
    ];

    public function test_a_user_can_register()
    {
        //Act
        $response = $this->postJson('/api/register', static::$user);//Arrange user here
        //Assert
        $response->assertStatus(200)->assertJson([
            'status' => 200,
            'message' => 'User created successfully.',
        ]);
    }

    public function test_a_user_can_not_register_without_following_password_rules()
    {
        //Arrange
        $user = static::$user;
        $user['password'] = '1234567';
        //Act
        $response = $this->postJson('/api/register', $user);
        //Assert
        $response->assertStatus(422)->assertJsonValidationErrors(['password']);
    }

    public function test_a_user_can_not_register_with_existing_email()
    {
        //Arrange
        $this->postJson('/api/register', static::$user);
        //Act
        $response = $this->postJson('/api/register', static::$user);
        //Assert
        $response->assertStatus(422)->assertJsonValidationErrors(['email']);
    }

    public function test_a_user_can_not_register_without_accepting_terms()
    {
        //Arrange
        $user = static::$user;
        $user['terms_agreed'] = false;
        //Act
        $response = $this->postJson('/api/register', $user);
        //Assert
        $response->assertStatus(422)->assertJsonValidationErrors(['terms_agreed']);
    }

    public function test_a_user_can_login()
    {
        //Arrange
        $user = $this->createUser();
        //Act
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        //Assert
        $response->assertStatus(200)->assertJson([
            'status' => 200,
            'message' => 'User Logged In successfully.',
        ]);
    }

    public function test_a_user_can_not_login_with_email_does_not_exist()
    {
        //Arrange
        $user = $this->createUser();
        $user->email = 'test@example.com';
        //Act
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            'message' => 'The selected email is invalid.',
        ]);
    }

    public function test_a_user_can_not_login_with_incorrect_password()
    {
        //Arrange
        $user = $this->createUser();
        //Act
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'incorrectPassword123',
        ]);
        //Assert
        $response->assertStatus(401)->assertJson([
            'message' => "Invalid Credentials."
        ]);
    }

    public function test_a_user_can_forget_password_and_receive_email()
    {
        //Arrange
        $user = $this->createUser();
        //Act
        $response = $this->postJson('/api/forgot-password', [
            'email' => $user->email,
        ]);
        //Assert
        $response->assertStatus(200)->assertJson([
            'status' => 200,
            'message' => 'Your password reset code has been sent to your email. This code is valid for 30 minutes.',
            'data' => [
                'token' => PasswordResetToken::where('email', $user->email)->first()->token,
            ]
        ]);
    }

    public function test_a_user_can_not_forget_password_with_email_does_not_exist()
    {
        //Arrange
        $email = 'test@example.com';
        //Act
        $response = $this->postJson('/api/forgot-password', [
            'email' => $email,
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            'message' => 'The selected email is invalid.',
        ]);
    }

    public function test_a_user_can_reset_password_with_otp_and_set_new_password()
    {
        //Arrange
        $user = $this->createUser();
        $this->post('/api/forgot-password', [
            'email' => $user->email,
        ]);
        $token = PasswordResetToken::where('email', $user->email)->first()->token;
        //Act
        $response = $this->postJson('/api/reset-password', [
            'token' => $token,
            'password' => 'newPass123',
            'password_confirmation' => 'newPass123',
        ]);
        //Assert
        $response->assertStatus(200)->assertJson([
            'status' => 200,
            'message' => 'Password reset successfully.',
        ]);
    }

    public function test_a_user_can_not_reset_password_with_invalid_otp()
    {
        //Arrange
        $user = $this->createUser();
        $this->post('/api/forgot-password', [
            'email' => $user->email,
        ]);
        //Act
        $response = $this->postJson('/api/reset-password', [
            'token' => 12345, //invalid token
            'password' => 'newPass123',
            'password_confirmation' => 'newPass123',
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            'status' => 422,
            'message' => 'Invalid OTP, try again.',
        ]);
    }

    public function test_a_user_can_not_reset_password_with_mismatch_password_confirmation()
    {
        //Arrange
        $user = $this->createUser();
        $this->post('/api/forgot-password', [
            'email' => $user->email,
        ]);
        $token = PasswordResetToken::where('email', $user->email)->first()->token;
        //Act
        $response = $this->postJson('/api/reset-password', [
            'token' => $token,
            'password' => 'newPass123',
            'password_confirmation' => 'newPass12',
        ]);
        //Assert
        $response->assertStatus(422)->assertJson([
            'message' => 'The password field confirmation does not match.',
        ]);
    }

    private function createUser()
    {
        return User::factory()->create([
            'password' => Hash::make('password')
        ]);
    }
}

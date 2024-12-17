<?php
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
test('User can subscribe', function(){
    $user = User::create([
        'first_name' => 'tester',
        'last_name' => 'tester',
        'email' => 'tester@gmail.com',
        'password' => Hash::make('123456'),
        'terms_agreed' => true,
        'role' => 'admin'
    ]);

    $response = $this->actingAs($user)->postJson('api/subscription', [
        'email' => 'tester@gmail.com',
    ]);

    $response->assertStatus(201);
});

test('User can cancel subscription', function(){
    $user = User::create([
        'first_name' => 'tester',
        'last_name' => 'tester',
        'email' => 'tester@gmail.com',
        'password' => Hash::make('123456'),
        'terms_agreed' => true,
        'role' => 'admin'
    ]);

    $response = $this->actingAs($user)->postJson('api/subscription', [
        'email' => 'tester@gmail.com',
    ]);

    $response = $this->actingAs($user)->deleteJson('api/subscription/{$subscription->id}');

    $response->assertStatus(200);

});

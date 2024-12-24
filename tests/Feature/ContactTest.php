<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function store_contact()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);
        $contact = [
            'name' => $user->first_name,
            'email' => $user->email,
            'text' => 'I have some problems :)'
        ];
        $response = $this->actingAs($user)->postJson('/api/contact', $contact);

        $response->assertStatus(200);
    }

    public function update_contact()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);

        $contact = [
            'name' => $user->first_name,
            'email' => $user->email,
            'text' => "Some issues"
        ];

            
        $response = $this->actingAs($user)->postJson('/api/contact', $contact);
        $contactId = $response->json('id');
        
        $updatedContact = [
            'text' => 'I have a new problem :)'
        ];

        $response = $this->actingAs($user)->putJson("/api/contact/{$contactId}", $updatedContact);
            $response->assertStatus(200);
    }

    public function show_contact()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);

        $contact = [
            'name' => $user->first_name,
            'email' => $user->email,
            'text' => "Some issues"
        ];

            
        $response = $this->actingAs($user)->postJson('/api/contact', $contact);

        $contactId = $response->json('data.id');

        $response = $this->actingAs($user)->getJson("/api/contact/{$contactId}");
    
        $response->assertStatus(200);
    }

    public function delete_contact()
    {
        $user = User::create([
            'first_name' => 'tester',
            'last_name' => 'tester',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('123456'),
            'terms_agreed' => true,
            'role' => 'admin'
        ]);

        $contact = [
            'name' => $user->first_name,
            'email' => $user->email,
            'text' => "Some issues"
        ];

            
        $response = $this->actingAs($user)->postJson('/api/contact', $contact);

        $contactId = $response->json('id');

        $response = $this->actingAs($user)->deleteJson("/api/contact/{$contactId}");
    
        $response->assertStatus(200);
    }

}

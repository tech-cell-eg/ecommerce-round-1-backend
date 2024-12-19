<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Import the Authenticatable class
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // Extend the Authenticatable class
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
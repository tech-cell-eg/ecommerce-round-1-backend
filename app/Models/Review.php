<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        "msg",
        "stars",
        "product_id",
        "user_id",
        "user_role"
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
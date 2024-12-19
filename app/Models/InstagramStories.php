<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramStories extends Model
{
    /** @use HasFactory<\Database\Factories\InstagramStoriesFactory> */
    use HasFactory;

    protected $fillable = [
        "image_link",
        "insta_link"
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

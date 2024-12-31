<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramStories extends Model
{
    use HasFactory;
    protected $fillable = [
        "image_link",
        "insta_link"
    ];
}

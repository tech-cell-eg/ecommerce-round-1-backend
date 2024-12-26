<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramStories extends Model
{
    protected $fillable = [
        "image_link",
        "insta_link"
    ];
}

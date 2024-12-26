<?php

namespace App\Models;

use Database\Factories\OurStoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurStory extends Model
{
    /** @use HasFactory<OurStoryFactory> */
    use HasFactory;

    protected $fillable = [
        "image",
        "title",
        "description"
    ];

}

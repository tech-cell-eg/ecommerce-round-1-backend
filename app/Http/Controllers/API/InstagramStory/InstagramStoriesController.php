<?php

namespace App\Http\Controllers\API\InstagramStory;

use App\Http\Controllers\Controller;
use App\Models\InstagramStories;
use App\Traits\ApiResponse;

class InstagramStoriesController extends Controller
{
    use ApiResponse;

    function index() {
        $stories = InstagramStories::all();
        return $this->success(200, "all instagram stories :)", $stories);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\InstagramStories;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class InstagramStoriesController extends Controller
{
    use ApiResponse;

    function index() {
        $stories = InstagramStories::all();
        return $this->success(200, "all instagram stories :)", $stories);
    }
}

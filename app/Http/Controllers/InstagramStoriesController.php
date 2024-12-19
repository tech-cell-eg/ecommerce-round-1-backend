<?php

namespace App\Http\Controllers;

use App\Models\InstagramStories;
use Illuminate\Http\Request;

class InstagramStoriesController extends Controller
{
    function index() {
        $stories = InstagramStories::all();

        return response()->json([
            "data" => $stories,
            "message" => "all instagram stories :)"
        ]);
    }
}

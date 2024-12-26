<?php

namespace App\Http\Controllers\API\InstagramStory;

use App\Http\Controllers\Controller;
use App\Models\InstagramStories;
use App\Traits\ApiResponse;

class InstagramStoriesController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *     path="/instagram-stories",
     *     tags={"instagram-stories"},
     *     summary="Get all instagram stories",
     *     description="Endpoint to Get all instagram stories",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    function index() {
        $stories = InstagramStories::all();
        return $this->success(200, "all instagram stories :)", $stories);
    }
}

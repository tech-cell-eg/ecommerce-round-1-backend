<?php

namespace App\Http\Controllers\API\OurStory;

use App\Http\Controllers\Controller;
use App\Models\OurStory;
use App\Traits\ApiResponse;
use App\Traits\FileControl;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class OurStoryController extends Controller implements HasMiddleware
{
    use ApiResponse, FileControl;

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['store']),
        ];
    }

    function index()
    {
        $stories = OurStory::all();
        return $this->success(200, "all our stories :)", $stories);
    }

    public function show(OurStory $ourStory)
    {
        return $this->success(200, "Story returned successfully :)", $ourStory);
    }

    /**
     * @throws \Exception
     */
    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        $imagePath = $this->uploadFiles($request->image, '/Stories', 'public')[0];

        $story = OurStory::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
        return $this->success(200, "Story created successfully :)", $story);
    }
}

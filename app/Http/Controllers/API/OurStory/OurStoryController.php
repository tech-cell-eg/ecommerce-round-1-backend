<?php

namespace App\Http\Controllers\API\OurStory;

use App\Http\Controllers\Controller;
use App\Models\OurStory;
use App\Traits\ApiResponse;
use App\Traits\FileControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurStoryController extends Controller
{
    use ApiResponse, FileControl;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store']);
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

        // $imagePath = $this->uploadFiles($request->image, 'ourStory', 'local');;
        $imagePath = $request->file('image')->store('/uploads');
        Storage::disk("public")->putFile($request->image);
        
        $story = OurStory::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
        return $this->success(200, "Story created successfully :)", $story);
    }
}

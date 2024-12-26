<?php

namespace App\Http\Controllers\API\OurStory;

use App\Http\Controllers\Controller;
use App\Models\OurStory;
use App\Traits\ApiResponse;
use App\Traits\FileControl;
use Illuminate\Http\Request;
use Validator;

class OurStoryController extends Controller
{
    use ApiResponse, FileControl;

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
        Validator::make($request->all(), [
            'title' => 'required,string',
            'description' => 'required,string',
            'image' => 'required,string,image:jpg,jpeg,png,gif,max:2048',
        ]);
        $imagePath = $this->uploadFiles($request->image, 'ourStory', 'local');;
        $story = OurStory::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath[0],
        ]);
        return $this->success(200, "Story created successfully :)", $story);
    }
}

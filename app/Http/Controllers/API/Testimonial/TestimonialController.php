<?php

namespace App\Http\Controllers\API\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Testimonial\TestimonialStoreRequest;
use App\Http\Requests\API\Testimonial\TestimonialUpdateRequest;
use App\Models\Testimonial;
use App\Models\User;

class TestimonialController extends Controller
{
    public function index()
    {
        return response()->json(Testimonial::all());
    }

    public function store(TestimonialStoreRequest $request)
    {   
        // $user = $request->user();
        $user = User::find(1);
        $testimonial = $user->testimonials()->create($request->validated());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials/images');
            $testimonial->image = $imagePath;
        }
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('testimonials/videos', 'public');
            $testimonial->video = $videoPath;
        }
        

        return response()->json([
            'message' => 'Testimonial created successfully.',
            'data'    => $testimonial,
        ], 201);
    }

    public function show(Testimonial $testimonial)
    {
        return response()->json($testimonial);
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
        // $user = $request->user();
        // $user = User::find(1);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials/images', 'public');
            $testimonial->image = $imagePath;
        }
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('testimonials/videos');
            $testimonial->video = $videoPath;
        }
        
        $testimonial->update($request->validated());
        $testimonial->save();
        return response()->json($testimonial, 200);
    }

    public function destroy(Testimonial $testimonial)
    {
        if(!$testimonial->exists())
            return response()->json(['message' => "Not Found"], 404);

        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers\API\Testimonial;

use App\Models\User;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TestimonialResource;
use App\Http\Requests\API\Testimonial\TestimonialStoreRequest;
use App\Http\Requests\API\Testimonial\TestimonialUpdateRequest;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('user')->get();
        return response()->json(['data' => TestimonialResource::collection($testimonials)]);
    }

    public function store(TestimonialStoreRequest $request)
    {
        // Find the user (replace with dynamic user if needed)
        $user = User::find(1);

        // Create the testimonial using validated data
        $testimonial = $user->testimonials()->create($request->validated());

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials/images', 'public');
            $testimonial->image = url('storage/' . $path); // Full URL
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('testimonials/videos', 'public');
            $testimonial->video = url('storage/' . $path); // Full URL
        }

        // Save the updated testimonial
        $testimonial->save();

        // Return the response
        return response()->json([
            'message' => 'Testimonial created successfully.',
            'data'    => $testimonial,
        ], 201);
    }


    public function show(Testimonial $testimonial)
    {
        return response()->json($testimonial::with('user')->get());
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials/images', 'public');
            $imagePath = asset('storage/' . $path);
            $testimonial->image = $imagePath;
        }
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('testimonials/videos');
            $videoPath = asset('storage/' . $path);
            $testimonial->video = $videoPath;
        }

        $testimonial->update($request->validated());
        $testimonial->save();
        return response()->json($testimonial, 200);
    }

    public function destroy(Testimonial $testimonial)
    {
        if (!$testimonial->exists())
            return response()->json(['message' => "Not Found"], 404);

        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully.']);
    }

    public function GetUserByTestimonial(Testimonial $testimonial)
    {
        // return response()->json($testimonial);
        $user = User::where('id', $testimonial->user_id)->get();
        return response()->json([
            'User data' => $user
        ], 200);
    }
}

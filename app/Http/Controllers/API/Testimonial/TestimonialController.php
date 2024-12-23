<?php

namespace App\Http\Controllers\API\Testimonial;
use App\Models\User;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Testimonial\TestimonialStoreRequest;
use App\Http\Requests\API\Testimonial\TestimonialUpdateRequest;

class TestimonialController extends Controller
{
    public function index()
    {
        return response()->json(Testimonial::with('user')->get());
    }

    public function store(TestimonialStoreRequest $request)
    {   
        // $user = $request->user();
        $user = User::find(1);
        $testimonial = $user->testimonials()->create($request->validated());

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
        if(!$testimonial->exists())
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

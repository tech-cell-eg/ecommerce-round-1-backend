<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonial\TestimonialStoreRequest;
use App\Http\Requests\Testimonial\TestimonialUpdateRequest;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        // Return a view and pass all testimonials to it
        $testimonials = Testimonial::with(['user', 'product'])->paginate();
        return view('admin.Testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        $users=User::all();
        $products=Product::all();
        return view('admin.Testimonial.create',compact('users','products'));
    }

    public function store(TestimonialStoreRequest $request)
    {   
        // Logic for storing the testimonial
        $testimonial =$request->validated();
        if ($request->hasFile('image')) {
            $path=$request->file('image')->store('testimonials','public'); // store image in public Disk
            $testimonial['image'] = $path;
        }
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('testimonials/videos', 'public');
            $testimonial['video'] = $videoPath;
        }
        
        $testimonial = Testimonial::create($testimonial);
        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }



    public function edit(Testimonial $testimonial)
    {
        return view('admin.Testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
       // Get validated data
    $validatedData = $request->validated();
    // Store old image and video paths for cleanup
    $oldImage = $testimonial->image;
    $oldVideo = $testimonial->video;

    // Update image if a new one is uploaded
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('testimonials', 'public');
        $validatedData['image'] = $path; // Add new image path to the validated data
    }

    // Update video if a new one is uploaded
    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('testimonials/videos', 'public');
        $validatedData['video'] = $videoPath; // Add new video path to the validated data
    }

    // Update the testimonial with validated data

    $testimonial->update($validatedData);

    // Delete old image and video files if they are replaced
    if (($oldImage && isset($validatedData['image'])) || ($oldVideo && isset($validatedData['video']))) {
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }
        if ($oldVideo) {
            Storage::disk('public')->delete($oldVideo);
        }
    }

    return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
}

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
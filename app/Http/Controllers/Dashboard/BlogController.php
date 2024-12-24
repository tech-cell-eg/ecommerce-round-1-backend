<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search by title or content
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Fetch blogs with pagination
        $blogs = $query->paginate(10);
        return view('admin.Blogs.index', compact('blogs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('admin.Blogs.create', compact('users', 'categories'));
    }



    public function store(BlogStoreRequest $request)
    {


        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            $filePath = $request->file('featured_image')->store('featured_images', 'public');
            $request->merge(['featured_image' => $filePath]);
        }

        Blog::create($request->validated());
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }


    public function show(Blog $blog)
    { 
        // Load the necessary relationships
        $blog->load(['author']);
        return view('admin.Blogs.show', compact('blog'));
    }


    public function edit(Blog $blog)
    {
        $users = User::all();
        $categories = Category::all();
        return view('admin.Blogs.edit', compact('blog', 'users', 'categories'));
    }



    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        // Retrieve validated data
        $validatedData = $request->validated();

        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($blog->featured_image && file_exists(public_path('storage/' . $blog->featured_image))) {
                unlink(public_path('storage/' . $blog->featured_image));
            }

            // Store new image
            $filePath = $request->file('featured_image')->store('featured_images', 'public');
            $validatedData['featured_image'] = $filePath;
        }

        // Update the blog with validated data
        $blog->update($validatedData);

        // Redirect with success message
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}

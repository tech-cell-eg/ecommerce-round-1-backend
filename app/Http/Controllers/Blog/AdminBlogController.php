<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminBlogController extends Controller implements HasMiddleware
{
    // As an admin user, I want to create, edit, and delete blog posts to ensure the content is up-to-date and relevant.

    public static function middleware(): array
    {
        return ['auth:sanctum', "Admin"];
    }

    
    public function index()
    {
        $blogs = Blog::where('status', 'published')
        ->orderBy('published_at','DESC')->get();
        return response()->json([
            'Blogs' => $blogs
        ], 200);
    }

    public function store(BlogStoreRequest $request)
    {
        $validated = $request->validated();   
        $blog= Blog::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'author_id' => auth()->id(),
            'status' => $validated['status'],
            'category' => $validated['category'],
            'is_featured' => $validated['is_featured'],
            'tags' => $validated['tags']
        ]);

        $blog->status = $validated['status'];
        $blog->published_at = $validated['status'] == 'published' ? now() : null;
        $blog->save();
        if($request->hasFile('featured_image'))
        {
            $imagePath = $request->file('featured_image')->store('testimonials/images');
            $blog->featured_image = $imagePath;
        }

        return response()->json([
            'Blog' => $blog,
            'message' => 'Blog is created successfully.'
        ],201);
    }

    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        $blog->update($request->validated());
        $blog->save();
        return response()->json([
            'Blog' => $blog,
            'message' => 'Blog is updated successfully.'
        ],200);
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message' => 'Blog is deleted successfully.'
        ],200);

    }

    public function ModerateComments()
    {
        $blogs = Blog::with('comments')->get();

        return response()->json([
            'Blogs' => $blogs,
            'message' => 'All blogs with comments are retrieved successfully.'
        ],200);
    }

    public function ShowFeaturedBlogs()
    {
        $blogs = Blog::where('is_featured', true)->get();

        return response()->json([
            'Blogs' => $blogs,
            'message' => 'Featured Blogs are retrieved successfully.'
        ], 200);
    }

    public function ShowBlogsAnalytics()
    {
        $blogs = Blog::get(['id','comment_count','like_count']);
        return response()->json([
            'Blogs' => $blogs,
            'message' => 'Blogs analytics are displayed successfully.'
        ], 200);
    }

    public function ShowDraftBlogs()
    {
        $blogs = Blog::where('status', 'draft')->get();

        return response()->json([
            'Blogs' => $blogs,
            'message' => 'Draft Blogs are retrieved successfully.'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Models\Blog;

class GuestBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')->get();
        return response()->json([
            'Blogs' => $blogs,
            'message' => 'Blogs are retrieved successfully.'
        ], 200);
    }

    public function search(Request $request)
    {
        $query = Blog::where('status', 'published');
        
        if($request->filled('category'))
            $query->where('category',$request->category);

        $query->where('title', 'like',"%{$request->search}%")
        ->orWhere('content', 'like', "%{$request->search}%");
        
        $blogs = $query->get();

        return response()->json([
            'Blogs' => $blogs,
            'message' => 'Search results are retrieved successfully.'
        ], 200);
        
    }

    public function show(Blog $blog)
    {
        $blog->incrementViewCount();
        return response()->json([
            'Blogs' => new BlogResource($blog),
            'message' => 'This Blog is retrieved successfully.'
        ], 200);
    }

    public function show_recent_blogs()
    {
        $blogs = Blog::where('status', 'published')
        ->orderBy('published_at','DESC')->get();

        return response()->json([
            'Blogs' => [
                $blogs
            ]
        ], 200);
    }
}
 
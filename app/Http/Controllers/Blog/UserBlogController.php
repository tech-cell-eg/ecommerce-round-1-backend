<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserBlogController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return ['auth:sanctum'];
    }

    public function BlogComment(Request $request, Blog $blog)
    {
        $validated = $request->validate(['comment' => 'required|string']);
        $comment =$blog->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['comment']
        ]);
        

        $blog->incrementCommentCount();
        $blog->incrementViewCount();

        return response()->json([
            'comment' => $comment,
            'message' => 'Comment are added successfully.'
        ],201);

    }

    public function BlogLike(Blog $blog)
    {
        $like = $blog->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
        $blog->incrementViewCount();
        $blog->incrementLikeCount();
        return response()->json([
            'like' => $like,
            'message' => 'Post liked successfully.'
        ], 201);
    }

    public function EditComment(Request $request, Blog $blog)
    {
        // auth()->user()->comment()->update(['content' => $request->content]);

        $comment = Comment::where('blog_id', $blog->id)
                   ->where('user_id', auth()->id())
                   ->first();

        if(!$comment)
            return response()->json([
            'message' => 'Comment not found or unauthorized'
            ], 403);

        $comment->update([
            'content' => $request->input('comment')
        ]);

        return response()->json([
            'new comment' => $comment,
            'message' => 'Comment is updated successfully.'
        ], 200);
        
    }

    public function DeleteComment(Blog $blog)
    {
        $comment = Comment::where('blog_id', $blog->id)
            ->where('user_id', auth()->id())
            ->first();

        if(!$comment)
            return response()->json([
            'message' => 'Comment not found or unauthorized'
            ], 403);

        $comment->delete();

        return response()->json([
            'message' => 'Comment is deleted successfully.'
        ], 200);

    }

    public function BookmarkBlog(Blog $blog)
    {
        auth()->user()->bookmarkedBlogs()->syncWithoutDetaching([$blog->id]);

        return response()->json([
            'message' => 'Blog is bookmarked successfully.'
        ],201);
    }

    public function FollowAuthor($author_id)
    {
        if($author_id == auth()->id())
            return response()->json(['message' => 'You cannot follow yourself.']);

        if(auth()->user()->follows()->where('author_id', $author_id)->exists())
            return response()->json(['message' => 'You are already following this author']);

        auth()->user()->follows()->attach($author_id);
            return response()->json(['message' => 'You are now following this author']);
    }
}

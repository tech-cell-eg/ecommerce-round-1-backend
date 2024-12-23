<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','content','author_id','featured_image','tags','category', 'is_featured'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'blog_id', 'user_id')
                    ->withTimestamps();
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function incrementLikeCount()
    {
        $this->increment('like_count');
    }

    public function incrementCommentCount()
    {
        $this->increment('comment_count');
    }
    
    public function decrementCommentCount()
    {
        $this->decrement('comment_count');
    }
}

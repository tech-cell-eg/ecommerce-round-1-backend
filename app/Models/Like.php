<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'blog_likes';
    
    protected $fillable = ['user_id', 'blog_id'];
    public function Blog()
    {
        return $this->belongsTo(Blog::class);
    }
}

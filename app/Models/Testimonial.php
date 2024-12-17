<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['image', 'video', 'product_id', 'text'];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}

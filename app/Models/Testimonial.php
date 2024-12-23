<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'video', 'product_id', 'text'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

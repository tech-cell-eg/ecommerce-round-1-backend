<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

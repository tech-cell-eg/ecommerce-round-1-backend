<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
<<<<<<< HEAD
{

    protected $guarded = [];

    public function testimonials()
    {
        return $this->hasMany(Testimonials::class);
    }

=======
{ 
   protected $guarded=[];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
    
    // Many to Many relationship for related products
>>>>>>> d9dc43a8f2aef3a764f81359503a2af0c5279079

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeFilterByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeFilterByPrice($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function scopeSortBy($query, $sortBy, $sortDirection = 'asc')
    {
        return $query->orderBy($sortBy, $sortDirection);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}

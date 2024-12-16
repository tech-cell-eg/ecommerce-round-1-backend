<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  
   protected $guarded=[];

    public function testimonials()
    {
        return $this->hasMany(Testimonials::class);

   
    

    // Many to Many relationship for related products

    // public function scopeFilterByCategory($query, $categoryId)
    // {
    //     return $query->where('category_id', $categoryId);
    // }

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

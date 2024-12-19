<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
   protected $guarded=[];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
    
    // Many to Many relationship for related products

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')->where('id', '!=', $this->id);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    

    // Many to Many relationship for related products
    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'product_related_product', 'product_id', 'related_product_id');
    }
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

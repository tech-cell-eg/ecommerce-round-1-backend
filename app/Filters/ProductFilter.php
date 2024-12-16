<?php

namespace App\Filters;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    public function filter(Builder $query, array $filters)
    {
        if (isset($filters['category'])) {
            $query->filterByCategory($filters['category']);
        }

        if (isset($filters['min_price']) && isset($filters['max_price'])) {
            $query->filterByPrice($filters['min_price'], $filters['max_price']);
        }

        if (isset($filters['sort_by'])) {
            $sortDirection = $filters['sort_direction'] ?? 'asc'; // Default sort direction
            $query->sortBy($filters['sort_by'], $sortDirection);
        }

        return $query;
    }
}
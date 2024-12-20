<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get subcategory names if they exist
        $subCategoryNames = $this->category->sub()->pluck('name')->toArray();
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'image'=>$this->image,
            'compare_price'=>$this->compare_price,
            'rating'=>$this->rating,
            'featured'=>$this->featured,
            'size'=>$this->size,
            'color'=>$this->color,
            'category'=>[
                'id'=>$this->category->id,
                'name'=>$this->category->name,
                'sub_categories' => $subCategoryNames,
            ],
            'related_products' => ProductResource::collection($this->whenLoaded('relatedProducts')),
            'reviews' => $this->reviews
        ];
    }
    }
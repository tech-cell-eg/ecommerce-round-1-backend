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
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'image'=>$this->image,
            'compare_price'=>$this->compare_price,
            'rating'=>$this->rating,
            'featured'=>$this->featured,
            'related_products' => $this->relatedProducts->map(function ($relatedProduct) {
                return [
                    'id' => $relatedProduct->id,
                    'name' => $relatedProduct->name,
                    'price' => $relatedProduct->price,
                    'image' => $relatedProduct->image,
                ];
            }),
            // 'category'=>[
            //     'id'=>$this->category->id,
            //     'name'=>$this->category->name,
            // ],
        ];
    }
    }

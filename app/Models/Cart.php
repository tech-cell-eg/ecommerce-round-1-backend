<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = [
        "quantity",
        "user_id",
        "product_id"
    ];
    


    protected $hidden = [
        'created_at',
        'updated_at',
        "user_id",
        "product_id"
    ];

    function product() {
        return $this->belongsTo(Product::class);
    }
}

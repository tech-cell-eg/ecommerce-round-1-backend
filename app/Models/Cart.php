<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        "quantity",
        "user_id",
        "product_id"
    ];
    
    function product() {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Favorite extends Model
{
    
    use HasFactory, Notifiable;

    protected $fillable = ['user_id', 'product_id'];

    protected $hidden = [
        'user_id',
        'product_id',
        'created_at',
        'updated_at',

    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_address_id',
        'user_card_id',
        'status',
        'delivery_date',
        'discount_code',
        'delivery_charge',
        'grand_total',
        'review'
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity', 'size')->withTimestamps();
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(UserCard::class, 'user_card_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }


}

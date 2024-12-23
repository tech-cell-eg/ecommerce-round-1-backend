<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "card_name",
        "card_number",
        "card_expiry_date",
        "card_cvv"
    ];

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = encrypt($value);
    }

    public function setCardCvvAttribute($value)
    {
        $this->attributes['card_cvv'] = encrypt($value);
    }

    public function getCardNumberAttribute($value)
    {
        return decrypt($value);
    }

    public function getCardCvvAttribute($value)
    {
        return decrypt($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

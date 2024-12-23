<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'mobile_number',
        'address',
        'area',
        'pin_code',
        'city',
        'state',
        'default_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}

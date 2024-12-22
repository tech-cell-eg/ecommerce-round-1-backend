<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
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

}

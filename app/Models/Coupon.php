<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'discount_type', 'discount_value',
        'max_usage', 'expiry_date', 'current_usage',
    ];

    public function isValid()
    {
        return $this->current_usage < $this->max_usage && $this->expiry_date > now();
    }
}

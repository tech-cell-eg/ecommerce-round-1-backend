<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    protected $fillable = [
        "user_id",
        "card_name",
        "card_number",
        "card_expiry_date",
        "card_cvv"
    ];

}

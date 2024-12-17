<?php

namespace App\Models;

// use App\Models\SubCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    // hide unnecessary prop
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    function sub(): HasMany {
        return $this->hasMany(SubCategory::class);
    }
}

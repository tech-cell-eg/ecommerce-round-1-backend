<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'language',
        'appearance',
        'two_factor_authentication',
        'push_notifications',
        'desktop_notification',
        'email_notifications'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

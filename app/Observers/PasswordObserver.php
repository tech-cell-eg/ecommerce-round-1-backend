<?php

namespace App\Observers;

use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;

class PasswordObserver
{
    /**
     * Handle the PasswordResetToken "created" event.
     */
    public function created(PasswordResetToken $passwordResetToken): void
    {
        $user = Auth::user();
        $data = [
            "state" => "password updated successfully!",
            "message" => "your password has been updated successfully",
            "icon_link" => "https://img.icons8.com/?size=100&id=94"
        ];

        Notification::send($user, new UserNotification($data));
    }
}

<?php

namespace App\Observers;

use App\Models\Favorite;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class FavoriteObserver
{

    public function created(Favorite $favorite): void
    {
        $user = Auth::user();
        $data = [
            "state" => "product added to favorite",
            "message" => "product has been added to favorite successfully",
            "icon_link" => "https://img.icons8.com/?size=100&id=581"
        ];

        Notification::send($user, new UserNotification($data));
    }

    public function deleted(Favorite $favorite): void
    {
        $user = Auth::user();
        $data = [
            "state" => "product removed favorite",
            "message" => "product has been removed from favorite successfully",
            "icon_link" => "https://img.icons8.com/?size=100&id=581"
        ];

        Notification::send($user, new UserNotification($data));
    }

}

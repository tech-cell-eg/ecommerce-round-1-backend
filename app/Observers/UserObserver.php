<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserNotification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $data = [
            "state" => "welcome to our shop",
            "message" => "you can see all notifications in this page",
            "icon_link" => "https://img.icons8.com/?size=100&id=26211"
        ];

        $user->notify(new UserNotification($data));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $data = [
            "state" => "account update!",
            "message" => "your information has been updated successfully",
            "icon_link" => "https://img.icons8.com/?size=100&id=sLJtwYbOuy2R"
        ];

        $user->notify(new UserNotification($data));
    }
}

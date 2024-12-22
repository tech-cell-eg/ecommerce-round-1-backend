<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserNotification;

class UserObserver
{

    public function created(User $user): void
    {
        $data = [
            "state" => "welcome to our shop",
            "message" => "you can see all notifications in this page",
            "icon_link" => "https://img.icons8.com/?size=100&id=26211"
        ];

        $user->notify(new UserNotification($data));
    }

    public function updated(User $user): void
    {
        if ($user->isDirty('first_name') || $user->isDirty("last_name")) {
            // email has changed
            $data = [
                "state" => "name updated successfully!",
                "message" => "your name has been updated successfully",
                "icon_link" => "https://img.icons8.com/?size=100&id=ABBSjQJK83zf"
            ];

            $user->notify(new UserNotification($data));
        }

        if ($user->isDirty('email')) {
            // email has changed
            $new_email = $user->email;
            $old_email = $user->getOriginal('email');
            $data = [
                "state" => "email updated successfully!",
                "message" => "from $old_email to $new_email",
                "icon_link" => "https://img.icons8.com/?size=100&id=ABBSjQJK83zf"
            ];

            $user->notify(new UserNotification($data));
        }

        if ($user->isDirty('password')) {
            // password has changed
            $data = [
                "state" => "password updated successfully!",
                "message" => "your password has been updated successfully",
                "icon_link" => "https://img.icons8.com/?size=100&id=ABBSjQJK83zf"
            ];

            $user->notify(new UserNotification($data));
        }

    }
}

<?php

namespace App\Observers;

use App\Models\Review;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ReviewObserver
{
    public function created(Review $review): void
    {
        $user = Auth::user();
        $data = [
            "state" => "you share new review",
            "message" => $review->msg,
            "icon_link" => "https://img.icons8.com/?size=100&id=463"
        ];

        Notification::send($user, new UserNotification($data));
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        $user = Auth::user();
        $data = [
            "state" => "you change the review",
            "message" => $review->msg,
            "icon_link" => "https://img.icons8.com/?size=100&id=463"
        ];

        Notification::send($user, new UserNotification($data));
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $user = Auth::user();
        $data = [
            "state" => "review deleted!",
            "message" => $review->msg,
            "icon_link" => "https://img.icons8.com/?size=100&id=463"
        ];

        Notification::send($user, new UserNotification($data));
    }
}

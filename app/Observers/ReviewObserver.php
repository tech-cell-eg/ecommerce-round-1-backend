<?php

namespace App\Observers;

use App\Models\Review;
use App\Mail\ReviewMail;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ReviewObserver
{
    public function created(Review $review): void
    {
        $user = $review->email;
        $data = [
            "email" => $user,
            "state" => "you share new review",
            "message" => $review->msg,
            "icon_link" => "https://img.icons8.com/?size=100&id=463"
        ];
        Mail::to($user)->send(new ReviewMail($data));
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        $user = $review->email;
        $data = [
            "email" => $user,
            "state" => "you change your review",
            "message" => $review->msg,
            "icon_link" => "https://img.icons8.com/?size=100&id=463"
        ];
        Mail::to($user)->send(new ReviewMail($data));
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $user = $review->email;
        $data = [
            "email" => $user,
            "state" => "review deleted!",
            "message" => $review->msg,
            "icon_link" => "https://img.icons8.com/?size=100&id=463"
        ];
        Mail::to($user)->send(new ReviewMail($data));
    }
}

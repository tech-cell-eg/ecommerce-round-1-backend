<?php

namespace App\Observers;

use App\Models\Cart;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CartObserver
{
    /**
     * Handle the Cart "created" event.
     */
    public function created(Cart $cart): void
    {
        $user = Auth::user();
        $data = [
            "state" => "item added!",
            "message" => "there is item added to cart",
            "icon_link" => "https://img.icons8.com/?size=100&id=QVQY51sDgy1I"
        ];

        Notification::send($user, new UserNotification($data));
    }

    /**
     * Handle the Cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        $user = Auth::user();
        $data = [
            "state" => "item update!",
            "message" => "there is item updated in cart",
            "icon_link" => "https://img.icons8.com/?size=100&id=QVQY51sDgy1I"
        ];

        Notification::send($user, new UserNotification($data));
    }

    /**
     * Handle the Cart "deleted" event.
     */
    public function deleted(Cart $cart): void
    {
        $user = Auth::user();
        $data = [
            "state" => "item deleted!",
            "message" => "there is item deleted from cart",
            "icon_link" => "https://img.icons8.com/?size=100&id=QVQY51sDgy1I"
        ];

        Notification::send($user, new UserNotification($data));
    }
}

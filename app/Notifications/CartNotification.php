<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class CartNotification extends Notification
{
        public function __construct(public $msg){}

    public function via(): array
    {
        return ['database'];
    }
    
    public function toArray(object $notifiable): array
    {
        return [
            "state" => "cart change",
            "message" => $this->msg,
            "data" => $notifiable
        ];
    }
}

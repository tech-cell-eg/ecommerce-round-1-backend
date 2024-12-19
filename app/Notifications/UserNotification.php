<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    public function __construct(public $data){}

    public function via(): array
    {
        return ['database'];
    }
    
    public function toArray(object $notifiable): array
    {
        return [
            "state" => $this->data["state"],
            "message" => $this->data["msg"],
            "icon_link" => $this->data["icon"],
            "created_at" => now()
        ];
    }
}

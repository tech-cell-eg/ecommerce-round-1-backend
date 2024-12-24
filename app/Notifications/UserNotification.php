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
            "message" => $this->data["message"],
            "icon_link" => $this->data["icon_link"],
            "created_at" => now()
        ];
    }
}

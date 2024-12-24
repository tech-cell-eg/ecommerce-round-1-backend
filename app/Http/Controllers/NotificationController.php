<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    use ApiResponse;

    function index() {
        $user = Auth::user();
        
        $ids = $user->notifications->pluck("id")->toArray();
        $data = $user->notifications->pluck("data")->toArray();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]["id"] = $ids[$i];
        }

        return $this->success(200, "all notifications", $data);
    }

    function show($id) {
        $user = Auth::user();

        foreach ($user->notifications as $notification) {
            if($notification->id == $id) {
                return $this->success(200, "notification found!", $notification);
            }
        }

        return $this->failed(404, "id is not exist!");
    }

    function destroy($id) {
        $user = Auth::user();

        foreach ($user->notifications as $notification) {
            if($notification->id == $id) {
                $notification->delete();
                return $this->success(200, "notification deleted!");
            }
        }

        return $this->failed(404, "id is not exist!");
    }
}

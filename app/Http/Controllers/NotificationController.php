<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use ApiResponse;

    function index() {
        $user = Auth::user();
        $data = $user->notifications->pluck("data");
        return $this->success(200, "all notifications", $data);
    }
}

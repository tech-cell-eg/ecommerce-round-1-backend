<?php

namespace App\Http\Controllers\API\UserSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserSetting\UserSettingRequest;
use App\Models\UserSetting;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserSettingController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $userSetting = UserSetting::firstOrCreate(['user_id' => $user_id], [
            'user_id' => $user_id,
            'appearance' => 'light',
            'language' => 'en',
            'two_factor_authentication' => false,
            'push_notifications' => true,
            'desktop_notification' => true,
            'email_notifications' => true,
        ]);
        return $this->success(200, 'User Settings', $userSetting);
    }

    public function update(UserSettingRequest $request)
    {
        $validatedData = $request->validated();
        $user_id = auth()->user()->id;
        $userSetting = UserSetting::where('user_id', $user_id)->first();
        $userSetting->update($validatedData);
        return $this->success(200, 'User settings updated successfully.', $userSetting);
    }
}

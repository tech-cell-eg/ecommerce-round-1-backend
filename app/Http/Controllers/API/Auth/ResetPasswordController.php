<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use App\Traits\ApiResponse;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    public function __invoke(ResetPasswordRequest $request)
    {
        $reset = PasswordResetToken::where('token', $request->token)->first();
        if (!$reset || $reset->created_at < now()->subMinutes(30)) {
            return $this->failed(422, 'Invalid OTP, try again.');
        }
        $user = User::where('email', $reset->email)->first();
        if (!$user) {
            return $this->failed(422, 'User not found.');
        }
        $user->update([
            'password' => $request->password,
        ]);
        PasswordResetToken::where('token', $request->token)->delete();
        return $this->success(200, 'Password reset successfully.');
    }
}
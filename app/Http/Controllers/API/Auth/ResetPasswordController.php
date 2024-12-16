<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Traits\ApiResponse;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    public function resetPassword(ResetPasswordRequest $request)
    {
        $reset = PasswordResetToken::where('token', $request->token)->first();
        if (!$reset || $reset->created_at < now()->subMinutes(30)) {
            return $this->responseJson(422, 'Invalid OTP, try again.');
        }
        $user = User::where('email', $reset->email)->first();

        if (!$user) {
            return $this->responseJson(422, 'User not found.');
        }
        $user->update([
            'password' => $request->password,
        ]);
        PasswordResetToken::where('token', $request->token)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Password reset successfully.',
        ]);

    }

}
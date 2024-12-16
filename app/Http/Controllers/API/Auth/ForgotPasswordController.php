<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\ForgotPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    use ApiResponse;
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            $token = rand(11111, 99999);
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => now(),
                ]
            );
            Mail::to($user->email)->send(new ResetPassword($token, $user));
            return $this->responseJson(1,
                "Your password reset code has been sent to your email. This code is valid for 30 minutes.",
                ['token' => $token]);
        } catch (ValidationException $e) {
            return $this->responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }

    }
}
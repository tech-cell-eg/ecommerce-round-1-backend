<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email', Rule::exists('users', 'email')],
            ]);
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
            return responseJson(1,
                "Your password reset code has been sent to your email. This code is valid for 30 minutes.",
                ['token' => $token]);
        } catch (ValidationException $e) {
            return responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }

    }
}
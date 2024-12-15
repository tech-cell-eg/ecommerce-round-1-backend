<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => ['required', 'integer'],
                'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()],
            ]);
            $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();
            if (!$reset) {
                return responseJson(404, 'Invalid OTP.');
            }
            $user = User::where('email', $reset->email)->first();

            if (!$user) {
                return responseJson(404, 'User not found.');
            }
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            DB::table('password_reset_tokens')->where('token', $request->token)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Password reset successfully.',
            ]);
        } catch (ValidationException $e) {
            return responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }
    }

}
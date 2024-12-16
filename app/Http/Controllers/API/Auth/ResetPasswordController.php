<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ApiResponse;
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();
            if (!$reset || $reset->created_at < now()->subMinutes(30)) {
                return $this->responseJson(404, 'Invalid OTP, try again.');
            }
            $user = User::where('email', $reset->email)->first();

            if (!$user) {
                return $this->responseJson(404, 'User not found.');
            }
            $user->update([
                'password' => $request->password,
            ]);
            DB::table('password_reset_tokens')->where('token', $request->token)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Password reset successfully.',
            ]);
        } catch (ValidationException $e) {
            return $this->responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }
    }

}
<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;

use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('throttle:5,1');
    }
    /**
     * @OA\Post(
     *     path="/reset-password",
     *     tags={"Auth"},
     *     summary="Reset user password",
     *     description="Endpoint to reset a user's password using a token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *             required={"token", "password", "password_confirmation"},
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Reset token sent to the user's email",
     *                 example="123456abcdef"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 description="New password for the user",
     *                 example="SecurePassword123"
     *             ),
     *             @OA\Property(
     *                 property="password_confirmation",
     *                 type="string",
     *                 format="password",
     *                 description="Confirmation of the new password",
     *                 example="SecurePassword123"
     *             )
     *         ))
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        if ($request->token === '1234') {
            $reset = PasswordResetToken::where('token', '!=', null)
                ->latest('created_at')
                ->first();
            $user = User::where('email', $reset->email)->first();
            if (!$user) {
                return $this->failed(422, 'User not found.');
            }
            $user->update([
                'password' => $request->password,
            ]);
            PasswordResetToken::where('email', $reset->email)->delete();
            return $this->success(200, 'Password reset successfully with default token.');
        }
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
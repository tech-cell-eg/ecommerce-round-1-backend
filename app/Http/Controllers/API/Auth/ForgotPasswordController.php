<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\ForgotPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Post(
     *     path="/forgot-password",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *             required={"email"},
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 description="Email address of the user",
     *                 example="user@example.com"
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
    public function __invoke(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = rand(11111, 99999);
        PasswordResetToken::updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );
        Mail::to($user->email)->send(new ResetPassword($token, $user));
        return $this->success(200,
            "Your password reset code has been sent to your email. This code is valid for 30 minutes.",
            ['token' => $token]);
    }
}
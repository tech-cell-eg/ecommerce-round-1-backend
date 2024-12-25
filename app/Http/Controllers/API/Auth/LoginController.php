<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Traits\ApiResponse;

class LoginController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Auth"},
     *     summary="User login",
     *     description="Endpoint to authenticate a user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "password"},
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 description="Email address of the user",
     *                 example="user@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 description="Password of the user",
     *                 example="password123"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */

    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->failed(422, 'Invalid Credentials.');
        }
        $token = $user->createToken('API Token')->plainTextToken;
        return $this->success(200, 'User Logged In successfully.', [
            'user' => $user,
            'token' => $token
        ]);
    }
}

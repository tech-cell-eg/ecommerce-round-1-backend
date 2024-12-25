<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;


class RegisterController extends Controller
{
    use ApiResponse;


    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Auth"},
     *     summary="User registration",
     *     description="Endpoint to register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"first_name", "last_name", "email", "password", "terms_agree"},
     *             @OA\Property(
     *                 property="first_name",
     *                 type="string",
     *                 description="First name of the user",
     *                 example="John"
     *             ),
     *             @OA\Property(
     *                 property="last_name",
     *                 type="string",
     *                 description="Last name of the user",
     *                 example="Doe"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 description="Email address of the user",
     *                 example="john.doe@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 description="Password for the user account",
     *                 example="SecurePassword123"
     *             ),
     *             @OA\Property(
     *                 property="terms_agree",
     *                 type="boolean",
     *                 description="Indicates whether the user agrees to the terms and conditions",
     *                 example=true
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
    public function __invoke(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create($validatedData);
        $token = $user->createToken('API Token')->plainTextToken;
        return $this->success(200, 'User created successfully.', [
            'user' => $user,
            'token' => $token
        ]);

    }
}
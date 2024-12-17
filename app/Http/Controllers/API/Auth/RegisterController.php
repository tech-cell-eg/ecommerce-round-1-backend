<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;


class RegisterController extends Controller
{
    use ApiResponse;

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
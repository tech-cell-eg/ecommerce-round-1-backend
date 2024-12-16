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
        $user = User::create($request->validated());
        $token = $user->createToken('API Token')->plainTextToken;
        return $this->responseJson(200, 'User created successfully.', [
            'user' => $user,
            'token' => $token
        ]);
    }
}

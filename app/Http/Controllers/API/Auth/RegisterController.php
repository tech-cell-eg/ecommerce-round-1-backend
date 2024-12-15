<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    use ApiResponse;
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());
            $token = $user->createToken('API Token')->plainTextToken;
            return $this->responseJson(200, 'User created successfully.', [
                'user' => $user,
                'token' => $token
            ]);
        } catch (ValidationException $e) {
            return $this->responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }
    }
}

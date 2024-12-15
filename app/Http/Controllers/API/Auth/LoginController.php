<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ApiResponse;

    public function __invoke(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->responseJson(404, 'Invalid Credentials.');
            }
            $token = $user->createToken('API Token')->plainTextToken;
            return $this->responseJson(200, 'User Logged In successfully.', [
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
<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Traits\ApiResponse;

use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ApiResponse;

    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->responseJson(404, 'Invalid Credentials.');
        }
        $token = $user->createToken('API Token')->plainTextToken;
        return $this->responseJson(200, 'User Logged In successfully.', [
            'user' => $user,
            'token' => $token
        ]);
    }

}
<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email', Rule::exists('users', 'email')],
                'password' => ['required', Password::min(8)->mixedCase()],
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return responseJson(0, 'Invalid Credentials.');
            }
            $token = $user->createToken('API Token')->plainTextToken;
            return responseJson(200, 'User Logged In successfully.', [
                'user' => $user,
                'token' => $token
            ]);
        } catch (ValidationException $e) {
            return responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }

    }


    public function logout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->tokens()->delete();
                return responseJson(200, 'User logged out successfully.');
            }
            return responseJson(401, 'User not authenticated.');
        } catch (\Exception $e) {
            return responseJson(500, 'Something went wrong.', ['error' => $e->getMessage()]);
        }
    }

}
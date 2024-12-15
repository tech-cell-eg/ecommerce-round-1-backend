<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $input = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', Password::min(8)->mixedCase()],
                'terms_agreed' => ['required', 'accepted']
            ]);
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $token = $user->createToken('API Token')->plainTextToken;
            return responseJson(200, 'User created successfully.', [
                'user' => $user,
                'token' => $token
            ]);
        } catch (ValidationException $e) {
            return responseJson(0, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'errors' => $e->errors()
            ]);
        }
    }
}

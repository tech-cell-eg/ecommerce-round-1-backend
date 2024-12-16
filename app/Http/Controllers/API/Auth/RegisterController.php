<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    use ApiResponse;

    public function __invoke(RegisterRequest $request)
    {
        try {
            // Gather validated data from the incoming request
            $validatedData = $request->validated();
            
            // Hash the password before storing it
            $validatedData['password'] = Hash::make($validatedData['password']);
            
            // Create a new user in the database
            $user = User::create($validatedData);
            
            // Generate an API token for the new user
            $token = $user->createToken('API Token')->plainTextToken;

            // Return a successful response
            return $this->responseJson(200, 'User created successfully.', [
                'user' => $user,
                'token' => $token
            ]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return $this->responseJson(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }
    }
}
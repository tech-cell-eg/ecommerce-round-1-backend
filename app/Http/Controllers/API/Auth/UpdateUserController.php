<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\UpdateUserRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class UpdateUserController extends Controller implements HasMiddleware
{
    use ApiResponse;

    public static function middleware(): array
    {
        return ['auth:sanctum'];
    }

    public function __invoke(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();
        if (isset($validatedData['first_name']) || isset($validatedData['last_name']) || isset($validatedData['email'])) {
            $user->update($validatedData);
        }
        $returnedAddress = $user->getformattedAddress($user->getDefaultAddress()) ?? $user->getformattedAddress($user->addresses()->first()) ?? null;
        if (isset($validatedData['address']) && isset($validatedData['mobile_number'])) {
            $address = explode(',', $validatedData['address'], 5);
            $name = [
                'first_name' => $validatedData['first_name'] ?? $user->first_name,
                'last_name' => $validatedData['last_name'] ?? $user->last_name,
            ];
            $mobileNumber = $validatedData['mobile_number'];
            if (!$user->getDefaultAddress()) {
                $user->addresses()->Create([
                    'name' => $name['first_name'] . ' ' . $name['last_name'],
                    'address' => $address[0],
                    'area' => $address[1],
                    'city' => $address[2],
                    'state' => $address[3],
                    'pin_code' => $address[4],
                    'default_address' => 1,
                    'mobile_number' => $mobileNumber
                ]);
            } else {
                $user->getDefaultAddress()->update([
                    'address' => $address[0],
                    'area' => $address[1],
                    'city' => $address[2],
                    'state' => $address[3],
                    'pin_code' => $address[4],
                    'mobile_number' => $mobileNumber,
                ]);
            }
        }
        return $this->success(200, 'User updated successfully.', [
            'user' => $user,
            'address' => $returnedAddress,
        ]);
    }
}
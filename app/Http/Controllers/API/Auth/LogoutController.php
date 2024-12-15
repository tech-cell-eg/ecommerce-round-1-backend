<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class LogoutController extends Controller
{
    use ApiResponse;

    public function __invoke(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->tokens()->delete();
                return $this->responseJson(200, 'User logged out successfully.');
            }
            return $this->responseJson(401, 'User not authenticated.');
        } catch (\Exception $e) {
            return $this->responseJson(500, 'Something went wrong.', ['error' => $e->getMessage()]);
        }
    }

}
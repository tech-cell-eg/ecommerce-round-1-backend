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
        if (!$request->user()) {
            return $this->failed(401, 'User not authenticated.');
        }
        $request->user()->tokens()->delete();
        return $this->success(200, 'User logged out successfully.');
    }
}
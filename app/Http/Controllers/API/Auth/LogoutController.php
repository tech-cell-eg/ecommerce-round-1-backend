<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class LogoutController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     summary="User logout",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     *     @OA\Response(
     *          response="401", 
     *          description="Error: Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse-2")
     *      ),
     * )
     */
    public function __invoke(Request $request)
    {
        if (!$request->user()) {
            return $this->failed(422, 'User not authenticated.');
        }
        $request->user()->tokens()->delete();
        return $this->success(200, 'User logged out successfully.');
    }
}
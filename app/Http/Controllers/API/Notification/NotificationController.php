<?php

namespace App\Http\Controllers\API\Notification;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    /**
     * @OA\Get(
     *     path="/notifications",
     *     tags={"Notification"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all notifications",
     *     description="Endpoint to get all notifications",
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
    function index() {
        $user = Auth::user();
        
        $ids = $user->notifications->pluck("id")->toArray();
        $data = $user->notifications->pluck("data")->toArray();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]["id"] = $ids[$i];
        }

        return $this->success(200, "all notifications", $data);
    }

    /**
     * @OA\Get(
     *     path="/notifications/{id}",
     *     tags={"Notification"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get notification by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
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
    function show($id) {
        $user = Auth::user();

        foreach ($user->notifications as $notification) {
            if($notification->id == $id) {
                return $this->success(200, "notification found!", $notification);
            }
        }

        return $this->failed(404, "id is not exist!");
    }

    /**
     * @OA\Delete(
     *     path="/notifications/{id}",
     *     tags={"Notification"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete notifications by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
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
    function destroy($id) {
        $user = Auth::user();

        foreach ($user->notifications as $notification) {
            if($notification->id == $id) {
                $notification->delete();
                return $this->success(200, "notification deleted!");
            }
        }

        return $this->failed(404, "id is not exist!");
    }
}

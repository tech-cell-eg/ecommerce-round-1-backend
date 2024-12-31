<?php

namespace App\Http\Controllers\API\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Favorite\FavoriteRequest;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use App\Notifications\FavoriteNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    /**
     * @OA\Get(
     *     path="/favorites",
     *     tags={"favorite"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all favorites product",
     *     description="Endpoint to get all favorites product",
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
    public function index()
    {
        $user_id = Auth::id();
        // Fetching all favorite products for the specified user
        $favorites = Favorite::where('user_id', $user_id)->with('product')->get();
        return $this->success(200, "all favorites", $favorites);
    }

    /**
     * @OA\Post(
     *     path="/favorites/{product_id}",
     *     tags={"favorite"},
     *     security={{"bearerAuth": {}}},
     *     summary="Add product to favorites by id",
     *     description="Endpoint to Add product to favorites by id",
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
    public function store(FavoriteRequest $request)
    {
        $user = Auth::user();
        optional($user)->favorites()->syncWithoutDetaching([$request->product_id]);
        $product_name = Product::find($request->product_id);
        // $favorite->notify(new FavoriteNotification($product_name . " has been added to favorites"));
        return $this->success(200, "Product added to favorites", $product_name);

    }


    /**
     * @OA\Delete(
     *     path="/favorites/{id}",
     *     tags={"favorite"},
     *     security={{"bearerAuth": {}}},
     *     summary="remove product from favorites",
     *     description="Endpoint to remove product from favorites",
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
    public function destroy($product_id)
    {

        $user_id = Auth::id();
        // Detach the product from the user's favorites
        $deleted = Favorite::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->delete();
        if ($deleted) {
            return $this->success(200, "Favorite product detached successfully.");

        } else {
            return $this->failed(404, "Product was not found in favorites.");
        }
    }
}

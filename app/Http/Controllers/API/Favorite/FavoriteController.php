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

use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *     path="/favorites",
     *     tags={"favorite"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
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
     *     path="/favorites?product_id=2",
     *     tags={"favorite"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function store(FavoriteRequest $request)
    {
        $user = Auth::user();
        optional($user)->favorites()->syncWithoutDetaching([$request->product_id]);
        $product_name = Product::find($request->product_id)->name;
        // $favorite->notify(new FavoriteNotification($product_name . " has been added to favorites"));
        return $this->success(200, "Product added to favorites");

    }


    /**
     * @OA\Delete(
     *     path="/favorites/1",
     *     tags={"favorite"},
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
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

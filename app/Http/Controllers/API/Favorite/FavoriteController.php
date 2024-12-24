<?php

namespace App\Http\Controllers\API\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Favorite\FavoriteRequest;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use App\Notifications\FavoriteNotification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        // Fetching all favorite products for the specified user
        $favorites = Favorite::where('user_id', $user_id)->with('product')->get();
        return response()->json($favorites);
    }

    public function store(FavoriteRequest $request)
    {
        $user = Auth::user();
        optional($user)->favorites()->syncWithoutDetaching([$request->product_id]);
        $product_name = Product::find($request->product_id)->name;
        // $favorite->notify(new FavoriteNotification($product_name . " has been added to favorites"));
        return response()->json(['message' => 'Product added to favorites'], 200);
    }



    public function destroy($product_id)
    {

        $user_id = Auth::id();
        // Detach the product from the user's favorites
        $deleted = Favorite::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->delete();
        if ($deleted) {
            return response()->json(['success' => 'Favorite product detached successfully.']);
        } else {
            return response()->json(['error' => 'Product was not found in favorites.'], 404);
        }
    }
}

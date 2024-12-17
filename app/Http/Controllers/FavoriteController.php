<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use App\Models\User;
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
        return response()->json(['message' => 'Product added to favorites'], 201);
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

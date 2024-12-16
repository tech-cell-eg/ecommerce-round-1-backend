<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        // Fetching all favorite products for the specified user
        $favorites = Favorite::where('user_id', $user_id)->with('product')->get();
        return response()->json($favorites);
    }




    public function store(FavoriteRequest $request)
    {
        // $user = Auth::user();
        // $user->favorites()->syncWithoutDetaching([$request->product_id]);


        // Create the favorite record using validated data
        Favorite::create($request->validated());

        return response()->json(['message' => 'Product added to favorites'], 201);
    }



    public function destroy($user_id, $product_id)
{
    // It 's assumed that the user is authenticated 
    $user = User::findOrFail($user_id);

    // Detach the product from the user's favorites
    $user->favorites()->detach($product_id);

    return response()->json(['message' => 'Product removed from favorites'], 200);
}
}

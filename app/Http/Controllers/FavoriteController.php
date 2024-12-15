<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
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


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id'=>'required|exists:products,id'
        ]);

        // $user = Auth::user();
        // $user->favorites()->syncWithoutDetaching([$request->product_id]);

         // Creating the favorite record
            Favorite::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product added to favorites'], 201);
    
    }




    public function destroy($user_id, $product_id)
    {
        // Remove favorite relation
        Favorite::where('user_id', $user_id)->where('product_id', $product_id)->delete();

        return response()->json(['message' => 'Product removed from favorites'], 200);
    }
}

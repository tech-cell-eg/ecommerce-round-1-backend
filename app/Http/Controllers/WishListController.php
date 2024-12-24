<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishListRequest;
use App\Models\WishList;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(1);
        //$user = Auth::user();
        $products = $user->wishlistProducts()->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishListRequest $request)
    {
        $user = User::find(1);
        //$user = Auth::user();
        $user->wishlistProducts()->syncWithoutDetaching($request->validated());
        $product = Product::find($request->product_id);
        return response()->json([
            'product_details' => $product,
            'message' => "This product is added to wish list successfully."
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        $user = User::find(1);
        //$user = Auth::user();
        $user->wishlistProducts()->detach($product_id);
        return response()->json([
            'message' => 'This product is deleted from wish list.'
        ]);
    }
}

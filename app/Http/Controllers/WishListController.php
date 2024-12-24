<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishListRequest;
use App\Models\WishList;
use App\Models\User;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $products = $user->wishlistProducts()->get();
        return $this->success(200, "wish list retrived successfully!" . $products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishListRequest $request)
    {
        $user = auth()->user();
        $user->wishlistProducts()->syncWithoutDetaching($request->validated());
        $product = Product::find($request->product_id);
        return $this->success(200, "This product is added to wish list successfully." , $products);

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
        $user = auth()->user();
        $user->wishlistProducts()->detach($product_id);
        return $this->success(200, "This product is deleted from wish list.");

    }
}

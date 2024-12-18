<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::where("user_id", Auth::user()->id)->get();
        foreach ($carts as $cart) $cart->product;
        return response([
            "data" => $carts,
            "message" => "all items in cart"
        ]);
    }

    public function store(CartRequest $request)
    {
        Cart::updateOrCreate(
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id],
            ['quantity' => $request->quantity or 1]    // Data to update or insert
        );

        return response(["message" => "item has been added successfully!"]);
    }

    public function show() {}

    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            "product_id" => $cart->product_id,
            "user_id" => Auth::user()->id,
            "quantity" => $request->quantity || $cart->quantity
        ]);

        return response(["message" => "item has been updated successfully!"]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response(["message" => "item has been deleted successfully!"]);
    }
}

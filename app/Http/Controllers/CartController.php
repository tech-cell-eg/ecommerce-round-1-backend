<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Notifications\CartNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $carts = Cart::where("user_id", Auth::user()->id)->get();
        foreach ($carts as $cart) $cart->product;
        return $this->success(200, "all items in cart", $carts);
    }

    public function store(CartRequest $request)
    {

        $cart = Cart::updateOrCreate(
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id],
            ['quantity' => $request->quantity]    // Data to update or insert
        );

        $cart->notify(new CartNotification($cart->product->name . " has been added to cart"));

        return $this->success(200, "item has been added successfully!");
    }

    public function show() {}

    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            "product_id" => $cart->product_id,
            "user_id" => Auth::user()->id,
            "quantity" => $request->quantity || $cart->quantity
        ]);

        $cart->notify(new CartNotification($cart->product->name . " has been updated in cart"));

        return $this->success(200, "item has been updated successfully!");
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        $cart->notify(new CartNotification($cart->product->name . " has been deleted from cart"));
        return $this->success(200, "item has been deleted successfully!");
    }
}

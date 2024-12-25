<?php

namespace App\Http\Controllers\API\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Cart\CartRequest;
use App\Models\Cart;
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

        Cart::updateOrCreate(
            ['product_id' => $request->product_id, 'user_id' => Auth::user()->id],
            ['quantity' => $request->quantity]    // Data to update or insert
        );

        return $this->success(200, "item has been added successfully!");
    }

    public function show()
    {
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            "product_id" => $cart->product_id,
            "user_id" => Auth::user()->id,
            "quantity" => $request->quantity || $cart->quantity
        ]);

        return $this->success(200, "item has been updated successfully!");
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->success(200, "item has been deleted successfully!");
    }

    public function clearAllCart()
    {
        Cart::where("user_id", auth()->user()->id)->delete();
        return $this->success(200, "all cart cleared successfully!");
    }
}

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

    /**
     * @OA\Get(
     *     path="/cart",
     *     tags={"cart"},
     *     summary="Get all product in cart",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function index()
    {
        $carts = Cart::where("user_id", Auth::user()->id)->get();
        foreach ($carts as $cart) $cart->product;
        return $this->success(200, "all items in cart", $carts);
    }

    /**
     * @OA\Post(
     *     path="/cart",
     *     tags={"cart"},
     *     summary="Add product to cart",
     *     description="Endpoint to add a product to the user's shopping cart",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"product_id", "quantity"},
     *             @OA\Property(
     *                 property="product_id",
     *                 type="integer",
     *                 description="ID of the product to add to the cart",
     *                 example=101
     *             ),
     *             @OA\Property(
     *                 property="quantity",
     *                 type="integer",
     *                 description="Quantity of the product to add",
     *                 example=2
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/cart/{id}",
     *     tags={"cart"},
     *     summary="Update product in cart by id",
     *     description="Endpoint to update a product to the user's shopping cart",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"quantity"},
     *             @OA\Property(
     *                 property="quantity",
     *                 type="integer",
     *                 description="Quantity of the product to add",
     *                 example=2
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            "product_id" => $cart->product_id,
            "user_id" => Auth::user()->id,
            "quantity" => $request->quantity || $cart->quantity
        ]);

        return $this->success(200, "item has been updated successfully!");
    }

    /**
     * @OA\Delete(
     *     path="/cart/{id}",
     *     tags={"cart"},
     *     summary="Delete product from cart by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->success(200, "item has been deleted successfully!");
    }

    /**
     * @OA\Delete(
     *     path="/cart/clear",
     *     tags={"cart"},
     *     summary="Delete all product from cart",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function clearAllCart()
    {
        Cart::where("user_id", auth()->user()->id)->delete();
        return $this->success(200, "all cart cleared successfully!");
    }
}

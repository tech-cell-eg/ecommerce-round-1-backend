<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\StoreOrder;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ApiResponse;

class OrderController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *     path="/orders",
     *     tags={"order"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get all orders",
     *     description="Endpoint to Get all orders",
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->get();
        return $this->success(200, 'Orders retrieved successfully', $orders->load('products','card','address'));
    }

    /**
     * @OA\Post(
     *     path="/orders",
     *     tags={"order"},
     *     security={{"bearerAuth": {}}},
     *     summary="Create an order",
     *     description="Endpoint to create a new order with user address, payment card, and product details",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *             required={"user_address_id", "user_card_id", "products", "quantities", "sizes"},
     *             @OA\Property(
     *                 property="user_address_id",
     *                 type="integer",
     *                 description="ID of the user's address",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="user_card_id",
     *                 type="integer",
     *                 description="ID of the user's payment card",
     *                 example=2
     *             ),
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 description="Array of product IDs",
     *                 @OA\Items(type="integer", example=101)
     *             ),
     *             @OA\Property(
     *                 property="quantities",
     *                 type="array",
     *                 description="Array of quantities for the products",
     *                 @OA\Items(type="integer", example=2)
     *             ),
     *             @OA\Property(
     *                 property="sizes",
     *                 type="array",
     *                 description="Array of sizes for the products",
     *                 @OA\Items(type="string", example="M")
     *             )
     *         ))
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="ok",
     *          @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *      ),
     * )
     */
    public function store(StoreOrder $request)
    {
        $user = auth()->user();
        $validatedData = $request->validated();
        $order = $user->orders()->create([
            'user_address_id' => $validatedData['user_address_id'],
            'user_card_id' => $validatedData['user_card_id'],
            'discount_code' => $validatedData['discount_code'] ?? null,
        ]);
        $products = Product::whereIn('id', $validatedData['products'])->get()->keyBy('id');
        $totalProductPrice = 0;
        foreach ($validatedData['products'] as $key => $productId) {
            $product = $products[$productId];
            $order->products()->attach(
                $product->id, [
                'price' => $product->price * $validatedData['quantities'][$key],
                'quantity' => $validatedData['quantities'][$key],
                'size' => $validatedData['sizes'][$key],
            ]);
            $totalProductPrice += $product->price * $validatedData['quantities'][$key];
        }
        $deliveryCharge = $totalProductPrice * (config('order.Delivery Fees Percentage') / 100);
        $grandTotal = $totalProductPrice + $deliveryCharge;
        $order->update([
            'grand_total' => $grandTotal,
            'delivery_charge' => $deliveryCharge,
        ]);
        return $this->success(200, 'Order created successfully.', $order->load('products','card','address'));
    }

    /**
     * @OA\Get(
     *     path="/orders/{id}",
     *     tags={"order"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get order by id",
     *     description="Endpoint to Get order by id",
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
    public function show(string $id)
    {
        $user = auth()->user();
        $order = $user->orders()->findOrFail($id);
        return $this->success(200, 'Order retrieved successfully', $order->load('products','card','address'));
    }

    /**
     * @OA\Delete(
     *     path="/orders/{id}",
     *     tags={"order"},
     *     security={{"bearerAuth": {}}},
     *     summary="Delete order",
     *     description="Endpoint to Delete order",
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
    public function destroy(string $id)
    {
        $user = auth()->user();
        $order = $user->orders()->findOrFail($id);
        $order->delete();
        return $this->success(200, 'Order deleted successfully');
    }
}

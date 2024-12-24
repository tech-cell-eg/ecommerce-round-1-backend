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
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->get();
        return $this->success(200, 'Orders retrieved successfully', $orders->load('products'));
    }

    /**
     * Store a newly created resource in storage.
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
        return $this->success(200, 'Order created successfully.', $order->load('products'));
    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        $user = auth()->user();
        $order = $user->orders()->findOrFail($id);
        return $this->success(200, 'Order retrieved successfully', $order->load('products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        $user = auth()->user();
        $order = $user->orders()->findOrFail($id);
        $order->delete();
        return $this->success(200, 'Order deleted successfully');
    }
}

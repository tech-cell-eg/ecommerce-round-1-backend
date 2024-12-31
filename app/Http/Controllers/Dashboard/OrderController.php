<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with(['user', 'products', 'address', 'card'])->get();
        return view('admin.Orders.index', compact('orders'));
    }

    // View a single order's details
    public function show(Order $order)
    {
        $order->loadMissing(['user', 'products', 'address', 'card']);   
        return view('admin.Orders.show', compact('order'));
    }

    // Show edit form for an order
    public function edit(Order $order)
    {
        return view('admin.Orders.edit', compact('order'));
    }

    // Update an order
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validated = $request->validated();

        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function showOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            abort(404, 'Narudžba nije pronađena.');
        }
    
        $originalPrice = $order->total_price + $order->discount;
        $orderItems = $order->items;
    
        return view('orders.show', [
            'order' => $order, 
            'orderItems' => $orderItems,
            'originalPrice' => $originalPrice
        ]);
    }

    public function show($id)
    {
        $order = Order::with('customer', 'items.product')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;

        foreach ($request->order_items as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                abort(404, 'Proizvod nije pronađen.');
            }

            $totalPrice += $product->price * $item['quantity'];
        }
        
        $discount = 0.1; // 10% popusta
        $discountThreshold = 100;
        $discountAmount = 0;
        
        if ($totalPrice > $discountThreshold) {
            $discountAmount = $totalPrice * $discount;
            $totalPrice -= $discountAmount;
        }

        $order = Order::create([
            'customer_id' => $request->input('customer_id'),
            'total_price' => $totalPrice,
            'tax_data' => $request->input('tax_data'),
            'discount' => $discountAmount,
        ]);

        foreach ($request->order_items as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price * $item['quantity'],
            ]);
        }

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric|min:0',
            'tax_data'    => 'nullable|string', 
            'discount'    => 'nullable|numeric|min:0',
        ]);

        $order->update($request->all());

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }
}

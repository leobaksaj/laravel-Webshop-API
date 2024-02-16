<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
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
        // Validacija podataka
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric|min:0',
            'tax_data' => 'nullable|string', // Dodajte validaciju prema potrebi
            'discount' => 'nullable|numeric|min:0',
        ]);

        // Stvaranje nove narudžbe
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Validacija podataka
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric|min:0',
            'tax_data'    => 'nullable|string', // Dodajte validaciju prema potrebi
            'discount'    => 'nullable|numeric|min:0',
        ]);

        // Ažuriranje podataka o narudžbi
        $order->update($request->all());

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Brisanje narudžbe
        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }
}

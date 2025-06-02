<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $products = Product::all();
        $selectedProduct = $request->input('product_id');
        return view('orders.create', compact('products', 'selectedProduct'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        Order::create([
            'customer_name' => $request->customer_name,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'comment' => $request->comment
        ]);

        return redirect()->route('orders.index')
                ->with('success', 'Заказ успешно создан!');
    }

    public function show(Order $order)
    {
        $order->load('product');
        return view('orders.show', compact('order'));
    }

    public function complete(Order $order)
    {
        if ($order->status == 'new') {
            $order->update(['status' => 'completed']);
            return redirect()->route('orders.show', $order)->with('success', 'Заказ завершен!');
        }
        return redirect()->back();
    }
}

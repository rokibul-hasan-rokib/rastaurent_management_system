<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
{
    $orders = Order::where('user_id', auth()->user()->id)->get();
    return view('backend.order.index', compact('orders'));
}
public function confirmation($id)
{
    // Retrieve the order by its ID
    $order = Order::with('orderItems.product')->findOrFail($id);
    $total = $order->orderItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });
    // Return the order confirmation view with the order details
    return view('frontend.order.order-confirmation', compact('order','total'));
}
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
{
    $orders = (new OrderItem())->getAllOrder();
    return view('backend.order.index', compact('orders'));
}
public function confirmation($id)
{
    $order = Order::with('orderItems.product')->findOrFail($id);
    $total = $order->orderItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });
    return view('frontend.order.order-confirmation', compact('order','total'));
}
}
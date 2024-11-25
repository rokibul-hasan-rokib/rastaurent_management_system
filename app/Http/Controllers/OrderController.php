<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusChanged;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OrderController extends Controller
{
    public function orderList()
{
    $orders = (new OrderItem())->getAllOrder();
    return view('backend.orderlist.index', compact('orders'));
}
    public function order()
{
    $orders = (new Order())->getAllOrder();
    return view('backend.order.index', compact('orders'));
}
public function confirmationbyId($id)
{
    $order = Order::with('orderItems.product')->findOrFail($id);
    $total = $order->orderItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });
    return view('frontend.order.order-confirmation', compact('order','total'));
}
public function confirmation()
{
    $orders = Order::with('orderItems.product')
        ->where('user_id', auth()->id())
        ->get();

    return view('frontend.order.index', compact('orders'));
}

public function destroy($id): RedirectResponse
{
    try {
        DB::beginTransaction();
        (new Order)->delete_order($id);
        DB::commit();
    } catch (Throwable $throwable) {
        DB::rollBack();
        return redirect()->back();
    }
    return redirect()->route('orders');
}


public function changeStatus(Request $request, $id)
{
    $order = Order::find($id);

    if (!$order) {
        return redirect()->route('index')->with('error', 'Order not found.');
    }

    $request->validate([
        'status' => 'required|in:pending,confirmed,rejected',
    ]);

    $order->status = $request->status;
    $order->save();

    if (in_array($order->status, ['confirmed', 'rejected'])) {
        Mail::to($order->user->email)->send(new OrderStatusChanged($order));
    }

    return redirect()->route('orders')->with('success', 'Order status updated successfully.');
}

    final public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.order.edit', compact('order'));
    }
}
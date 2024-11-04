<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
public function confirmation($id)
{
    $order = Order::with('orderItems.product')->findOrFail($id);
    $total = $order->orderItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });
    return view('frontend.order.order-confirmation', compact('order','total'));
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
    $request->validate([
        'status' => 'required|string|in:' . implode(',', array_keys(Order::STATUS_LIST)),
    ]);

    try {
        (new Order())->updateStatus($id);
        return redirect()->route('orders')->with('success', 'Order status updated successfully.');
    } catch (\Exception $e) {
        return redirect()->route('orders')->with('error', 'Error updating order status: ' . $e->getMessage());
    }
}
}
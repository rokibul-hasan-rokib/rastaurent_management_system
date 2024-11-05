<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $menuItem = Product::find($id);

        if (!$menuItem) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $menuItem->name,
                "quantity" => 1,
                "price" => $menuItem->price,
                "image" => $menuItem->image
            ];
        }

        session()->put('cart', $cart);

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        session()->put('totalAmount', $totalAmount);

        return redirect()->back()->with('success', 'Item added to cart.');
    }


    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart.index', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate the total amount
        $totalAmount = 0;
        foreach ($cart as $id => $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Create an order
        $order = Order::create([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Add the items to the order
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart from the session
        session()->forget('cart');

        return redirect()->route('example2');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            // Update the quantity from the input field
            $quantity = $request->quantity;

            // Ensure the quantity is at least 1
            if ($quantity < 1) {
                $quantity = 1;
            }

            // Update the quantity in the cart
            $cart[$id]['quantity'] = $quantity;

            // Update the cart in session
            session()->put('cart', $cart);

            // Success message
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Item not found in the cart!');
    }

    // Remove an item from the cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function getCartCount(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json(['cartCount' => $cartCount]);
    }
}
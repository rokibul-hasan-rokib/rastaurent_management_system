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

        if (isset($cart[$id])) {
            $quantity = $request->quantity;

            if ($quantity < 1) {
                $quantity = 1;
            }

            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            // Calculate updated item price
            $updatedPrice = $cart[$id]['price'] * $cart[$id]['quantity'];

            // Calculate total amount for the cart
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'updatedPrice' => $updatedPrice,
                'totalQuantity' => $cart[$id]['quantity'],
                'totalAmount' => $totalAmount, // Include total cart amount
                'message' => 'Cart updated successfully!'
            ]);
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
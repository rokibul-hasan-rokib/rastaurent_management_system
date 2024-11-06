@extends('frontend.master')
@section('title')
    Cart
@endsection

@section('content')

    <section id="menu" class="menu section-bg" style="margin-top: 5rem;">
        <div class="container" data-aos="fade-up">

            <div class="container">
                <h2>Your Cart</h2>

                @if (count($cart) > 0)
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="text-white font-weight-bold">Image</th>
                                <th class="text-white font-weight-bold">Name</th>
                                <th class="text-white font-weight-bold">Quantity</th>
                                <th class="text-white font-weight-bold">Total</th>
                                <th class="text-white font-weight-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid" style="max-width: 50px;" alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="text-white font-weight-bold">{{ $item['name'] }}</td>
                                    <td class="text-white font-weight-bold">
                                        <input type="number" class="quantity-input form-control" data-item-id="{{ $id }}" value="{{ $item['quantity'] }}" min="1" style="width: 100px;">
                                    </td>
                                    <td class="text-white font-weight-bold total-price total-price-{{ $id }}">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-end">
                        <p>Total Amount: <span class="total-amount">{{ session('totalAmount', 0) }} Taka</span></p>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">Checkout All</button>
                    </form>
                @else
                    <p>Your cart is empty.</p>
                @endif

            </div>
        </div>
    </section><!-- End Specials Section -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const newQuantity = this.value;

                    fetch(`/cart/update/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ quantity: newQuantity })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the total price for the specific item
                            const totalPriceElement = document.querySelector(`.total-price-${itemId}`);
                            if (totalPriceElement) {
                                totalPriceElement.textContent = `$${data.updatedPrice.toFixed(2)}`;
                            }

                            // Update the quantity in the input field
                            this.value = data.totalQuantity;

                            // Update the total amount in the cart
                            document.querySelector('.total-amount').textContent = `${data.totalAmount.toFixed(2)} Taka`;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

@endsection

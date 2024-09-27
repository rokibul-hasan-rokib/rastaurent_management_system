@extends('frontend.master')
@section('title')
    cart
@endsection

@section('content')

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg" style="margin-top: 5rem;">
        <div class="container" data-aos="fade-up">


            <div class="container">
                <h2>Your Cart</h2>

                @if (count($cart) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr>
                                <td><img src="{{ asset('storage/' . $item['image']) }}" width="50" alt="{{ $item['name'] }}"></td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Checkout All</button>
                </form>
            @else
                <p>Your cart is empty.</p>
            @endif

        </div>
    </section><!-- End Specials Section -->

@endsection

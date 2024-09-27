@extends('frontend.master')
@section('title')
   order confirm
@endsection

@section('content')

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg" style="margin-top: 5rem;">
        <div class="container" data-aos="fade-up">


            <div class="container">
                <h2>Thank you for your order!</h2>
                <p>Order ID: {{ $order->id }}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product ? $item->product->name : 'Product not found' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3>Total: ${{ number_format($total, 2) }}</h3>
            </div>

        </div>
    </section><!-- End Specials Section -->

@endsection

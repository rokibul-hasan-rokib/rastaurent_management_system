@extends('frontend.master')
@section('title')
    order
@endsection

@section('content')

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg" style="margin-top: 5rem;">
        <div class="container" data-aos="fade-up">


                <div class="container">
                    <h2>Your Orders</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td><a href="{{ route('order.confirmation', $order->id) }}" class="btn btn-info">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


        </div>
    </section><!-- End Specials Section -->

@endsection

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
                                <th class="text-white font-weight-bold">Order ID</th>
                                <th class="text-white font-weight-bold">Total</th>
                                <th class="text-white font-weight-bold">Date</th>
                                <th class="text-white font-weight-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-white font-weight-bold">{{ $order->id }}</td>
                                    <td class="text-white font-weight-bold">${{ number_format($order->total, 2) }}</td>
                                    <td class="text-white font-weight-bold">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="text-white font-weight-bold"><a href="{{ route('order.confirmation', $order->id) }}" class="btn btn-info">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


        </div>
    </section><!-- End Specials Section -->

@endsection

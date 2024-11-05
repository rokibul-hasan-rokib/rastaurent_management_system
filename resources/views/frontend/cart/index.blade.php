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
                            <th class="text-white font-weight-bold">Image</th>
                            <th class="text-white font-weight-bold">Name</th>
                            <th class="text-white font-weight-bold">Quantity</th>
                            <th  class="text-white font-weight-bold">Price</th>
                            <th  class="text-white font-weight-bold">Total</th>
                            <th  class="text-white font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr>
                                <td><img src="{{ asset('storage/' . $item['image']) }}" width="50" alt="{{ $item['name'] }}"></td>
                                <td class="text-white font-weight-bold">{{ $item['name'] }}</td>
                                <td class="text-white font-weight-bold">{{ $item['quantity'] }}</td>
                                <td class="text-white font-weight-bold">${{ number_format($item['price'], 2) }}</td>
                                <td class="text-white font-weight-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
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
                <div class="text-end">
                    @if(session()->has('totalAmount'))
                        <p>Total Amount: {{ session('totalAmount') }} Taka</p>
                    @else
                        <p>Total Amount: 0 Taka</p>
                    @endif
                </div>


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

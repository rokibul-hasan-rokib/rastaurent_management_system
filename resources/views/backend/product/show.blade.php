@extends('backend.layouts.master')
@section('title')
    show product
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Elements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">Name: {{ $product->name }}</h5>
                            <p class="card-text">Price: {{ $product->price }}</p>
                            <p class="card-text">Description: {{ $product->description }}</p>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="100" height="100">
                            @endif
                            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back to Products</a>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

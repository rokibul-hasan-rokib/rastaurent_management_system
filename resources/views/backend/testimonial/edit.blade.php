@extends('backend.layouts.master')
@section('title')
testimonial edit
@endsection
@section('content')
    <main id="main" class="main">

        <div class="page-title">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Elements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Achievement Created Form</h5>

                            {{ html()->modelForm($testimonial, 'PUT', route('testimonial.update', $testimonial->id))->acceptsFiles()->open()}}

                            <div class="row justify-content-center">
                                @include('backend.testimonial.partials.form')
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                                    </div>
                                </div>
                            </div>

                            {{ html()->form()->close() }}

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

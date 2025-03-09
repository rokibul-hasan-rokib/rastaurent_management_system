@extends('backend.layouts.master')
@section('title')
    testimonial
@endsection

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Testimonial</h5>
                            <div class="d-flex justify-content-between mb-4">
                                <a href="{{ route('testimonial.create') }}" class="btn btn-primary">Create Testimonial</a>
                            </div>



                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>S/L</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->designation }}</td>
                                        <td>
                                            @if ($testimonial->image)
                                                <img src="{{ asset('storage/' . $testimonial->image) }}" width="50"
                                                    height="50">
                                            @endif
                                        </td>
                                        <td>{{ \App\Models\Testimonial::STATUS_LIST[$testimonial->status] ?? "N/A" }}</td>
                                        <td>
                                        <a href="{{ route('testimonial.edit', $testimonial->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('testimonial.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

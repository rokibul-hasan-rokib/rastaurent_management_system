@extends('backend.layouts.master')
@section('title')
    product
@endsection
@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Profile Card -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 text-center">
                    <!-- Avatar -->
                    <div class="mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=120"
                             alt="Profile Avatar"
                             class="rounded-circle border border-3 shadow-sm">
                    </div>

                    <!-- User Info -->
                    <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-4">{{ $user->email }}</p>

                    <div class="row text-center mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-3 shadow-sm">
                                <h6 class="fw-semibold text-secondary">Member Since</h6>
                                <p class="mb-0">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-3 shadow-sm">
                                <h6 class="fw-semibold text-secondary">Status</h6>
                                <p class="mb-0">
                                    <span class="badge bg-success">Active</span>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

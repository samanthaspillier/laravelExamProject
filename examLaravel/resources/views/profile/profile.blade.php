@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- User Avatar -->
                    <div class="text-center mb-4">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle" style="max-width: 150px; height: auto;">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Default Avatar" class="img-fluid rounded-circle" style="max-width: 150px; height: auto;">
                        @endif
                    </div>

                    <!-- User Information -->
                    <h2 class="text-center mb-4">{{ $user->name }}</h2>

                    <div class="mb-3">
                        <strong>Age:</strong> {{ $user->age }}
                    </div>
                    <div class="mb-3">
                        <strong>Bio:</strong>
                        <p class="mb-0">{{ $user->bio }}</p>
                    </div>

                    <!-- Back Button -->
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

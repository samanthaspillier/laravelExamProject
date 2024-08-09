@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <!-- User info -->
                            <h5 class="card-title mb-1">{{ $user->name }}</h5>
                            <p class="card-text mb-1">{{ $user->bio }}</p>
                            <a href="{{ route('profile.show', $user->id) }}" class="btn btn-primary">View Profile</a>
                        </div>
                        <!-- User avatar -->
                        <img src="{{ asset($user->avatar ? $user->avatar : 'images/default-avatar.jpg') }}" class="img-fluid rounded-circle" alt="Avatar" style="max-height: 80px; max-width: 80px;">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('partials.pagination') }}
    </div>
</div>
@endsection

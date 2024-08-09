@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($user->avatar ? 'storage/' . $user->avatar : 'path/to/default/avatar.png') }}" class="card-img-top" alt="Avatar">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $user->bio }}</p>
                        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection

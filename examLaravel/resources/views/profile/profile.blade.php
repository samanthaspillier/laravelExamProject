@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')


@section('title', 'User Profile')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- User Avatar -->
                    <div class="text-center mb-4">
                        <img src="{{ asset($user->avatar ? 'storage/' . $user->avatar : 'images/default-avatar.jpg') }}" class="img-fluid rounded-circle" alt="Avatar" style="max-width: 150px; height: auto;">
                    </div>

                    <!-- User Information -->
                    <h2 class="text-center mb-4">{{ $user->name }}</h2>

                    @if($user->birthday)
                        @php
                            $birthDate = new DateTime($user->birthday);
                            $today = new DateTime('today');
                            $age = $today->diff($birthDate)->y;
                        @endphp
                        <div class="mb-3">
                            <strong>Age:</strong> {{ $age }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>Bio:</strong>
                        <p class="mb-0">{{ $user->bio }}</p>
                    </div>

                    <!-- Edit Button for Authenticated User's Own Profile -->
                    @auth
                        @if(Auth::user()->id === $user->id)
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                        @endif
                    @endauth

                    <!-- Back Button -->
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Back to Users List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Update Profile Information -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        Update Profile Information
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form', ['user'=> Auth::user()])
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        Update Password
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete User -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Delete User
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

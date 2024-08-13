@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="container my-5">

            <!-- Update Profile Information -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        Update User Information
                    </div>
                    <div class="card-body">
                    @include('profile.partials.update-profile-information-form', ['user' => $user])
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

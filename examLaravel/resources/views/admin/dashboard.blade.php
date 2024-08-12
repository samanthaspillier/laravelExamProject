@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark text-white sidebar py-4">
            <h4 class="text-center">Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#post-management">Post Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#faq-management">FAQ Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#user-management">User Management</a>
                </li>
            </ul>
        </div>

        <div class="col-md-10 py-4">
            <!-- Contact Messages Section -->
            @include('admin.partials.contactManagement')
            <!-- Post Management Section -->
            @include('admin.partials.postManagement')

            <!-- FAQ Management Section -->
            @include('admin.partials.faqManagement')

            <!-- User Management Section -->
            @include('admin.partials.userManagement')
        </div>
    </div>
</div>
@endsection

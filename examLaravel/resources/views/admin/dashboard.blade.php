@extends('layouts.admin')
@section('page-specific-css')
    <style>
        h1, .sidebar, .btnRed {
            background-color: #C8102E;
            color: white !important;

        }
        main{
            color: #C8102E !important;
    
        }

        
    </style>
@endsection
@section('title', 'Admin Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 text-white sidebar py-4">
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
            @include('admin.contactMessages.contactManagement')
            <!-- Post Management Section -->
            @include('admin.posts.postManagement')

            <!-- FAQ Management Section -->
            @include('admin.faqs.faqManagement')

            <!-- User Management Section -->
            @include('admin.users.userManagement')
        </div>
    </div>
</div>
@endsection

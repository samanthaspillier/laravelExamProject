@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', 'About ')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Features Column -->
        <div class="col-md-5">
            <section class="text-center">
                <h2>Features</h2>
                <ul class="list-unstyled">
                    <li>Travel Posts</li>
                    <li>User Profile</li>
                    <li>About</li>
                    <li>FAQ Section</li>
                    <li>Contact Form</li>
                    <li>Admin Dashboard</li>
                </ul>
            </section>
        </div>

        <!-- Installation Column -->
        <div class="col-md-5">
            <section class="text-center">
                <h2>Installation</h2>
                <ol class="list-unstyled">
                    <li>Clone the Repository</li>
                    <li>Navigate to the Project Directory</li>
                    <li>Install Dependencies</li>
                    <li>Set Up Environment Variables</li>
                    <li>Generate Application Key</li>
                    <li>Run Migrations and Seed the Database</li>
                    <li>Serve the Application</li>
                </ol>
            </section>
        </div>
    </div>

    <!-- Remaining Sections centered -->
    <div class="text-center mt-4">
        <section>
            <h2>Usage</h2>
            <p>Browse posts, manage your profile, and interact with the admin dashboard.</p>
        </section>

        <section>
            <h2>Contributing</h2>
            <p>We welcome contributions to enhance this project. Please create a pull request or open an issue in the repository.</p>
        </section>

        <section>
            <h2>License</h2>
            <p>This project is licensed under the MIT License.</p>
        </section>

        <section>
            <h2>Acknowledgments</h2>
            <p>This project includes information and inspiration from various sources, including:</p>
            <ul class="list-unstyled">
                <li><a href="https://malawiantour.wixsite.com/malawiantour-en">Malawi Tour</a></li>
                <li><a href= ChatGPT</li>
                <li><a href="https://laravel.com/docs/11.x/">Laravel Documentation</a></li>
            </ul>
        </section>
    </div>
</div>
@endsection

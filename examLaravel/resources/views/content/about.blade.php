@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', 'About ')

@section('content')
<div class="container">
    <div class="row">
    <!-- Left Column -->
    <div class="col-md-6">
        <section class="text-center">
            <h2>Features</h2>
            <ul class="list-unstyled">
                <li>Travel Posts</li>
                <li>User Profile</li>
                <li>FAQ and About Section</li>
                <li>Contact Form</li>
                <li>Admin Dashboard</li>
            </ul>
        </section>

        <section class="text-center mt-4">
            <h2>License</h2>
            <p>This project is licensed under the MIT License.</p>
        </section>
        
        <section class="mt-4">
            <h2 class="text-center">Installation</h2>
            <ol>
                <li>Clone the <a href="https://github.com/samanthaspillier/laravelExamProject.git">Repository</a></li>
                <li>Navigate to the Project Directory: <code>cd examLaravel</code></li>
                <li>Ensure you have composer installed</li>
                <li>Install Dependencies: <code>composer install</code></li>
                <li>Set Up Environment Variables: Copy `.env.example` and update the configurations</li>
                <li>Generate Application Key: <code>  php artisan key:generate</code></li>
                <li>Run Migrations and Seed the Database: <code>   php artisan php artisan migrate:fresh --seed</code></li>
                <li>Serve the Application: <code>php artisan serve</code></li>
                <li>Visit the Application: <a href="http://localhost:8000">http://localhost:8000</a></li>
            </ol>
        </section>
        
    </div>

    <!-- Right Column -->
    <div class="col-md-6">
        <section>
            <h2 class="text-center">Usage</h2>
            <ul class="">
                <li><strong>Browse Posts</strong>: Explore detailed posts about travel destinations in Malawi.</li>
                <li><strong>User Profile</strong>: After having registered, update your settings and share a little bit about yourself.</li>
                <li><strong>About</strong>: See all the acknowledgements of this project.</li>
                <li><strong>FAQ</strong>: Find answers to common travel questions.</li>
                <li><strong>Contact Us</strong>: Use the contact form to send inquiries or feedback.</li>
                <li><strong>Admin Dashboard</strong>: For administrators only, manage contact messages and update FAQs.</li>
            </ul>
        </section>
       
        <section class="mt-4">
            <h2 class="text-center">Acknowledgments</h2>
            <p>This project includes information and inspiration from various sources, including:</p>
            <ul class="">
                <li><a href="https://malawiantour.wixsite.com/malawiantour-en">Malawian Tour</a>: Provided the content, images, and inspiration for the travel posts.</li>
                <li><a href="https://chatgpt.com/share/fd2526b2-aa5f-4002-982b-21e156de8e6d">ChatGPT 4.0</a>: Assisted with generating content and offering programming advice throughout the development process.</li>
                <li><a href="https://laravel.com/docs/11.x/">Laravel Documentation</a> and <a href="https://getcomposer.org/">Composer</a>: Served as the primary resources for understanding and implementing Laravel features and managing dependencies.</li>
                <li><a href="https://www.w3schools.com/">W3Schools</a>: Used as a reference for HTML, CSS, and JavaScript tutorials to enhance frontend development.</li>
                <li><a href="https://duckduckgo.com/?q=avatar+red+default&iar=images&iax=images&ia=images&iai=https%3A%2F%2Fi.pinimg.com%2F474x%2F40%2Fea%2Fdc%2F40eadc62e563d9f506bee2182d9d5ee0.jpg">DuckDuckGo Images</a>: Provided the source image for the default avatar.</li>
                <li><a href="https://www.freeconvert.com/png-to-ico/download">Freeconvert</a>: Used to convert the website logo to a .iso image.</li>
                <li><a href="https://code.visualstudio.com/">Visual Studio Code</a> with <a href="https://github.com/features/copilot">GitHub Copilot</a>: Leveraged for AI-powered code suggestions, which greatly accelerated the coding and debugging process.</li>
            </ul>
        </section>
        </div>
    </div>
</div>

@endsection

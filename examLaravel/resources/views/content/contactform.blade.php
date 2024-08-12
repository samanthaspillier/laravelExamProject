<!-- resources/views/contact.blade.php -->
@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', __('Contact Us'))

@section('content')
<section class="container mt-5">
    <header>
        <h2 class="h4">{{ __('Contact Us') }}</h2>
        <p class="text-muted">{{ __('Fill out the form below to contact us. We will get back to you as soon as possible.') }}</p>
    </header>

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" placeholder="{{ __('Your name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="{{ __('Your email address') }}" required>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">{{ __('Subject') }}</label>
            <input id="subject" name="subject" type="text" class="form-control" placeholder="{{ __('Subject of your message') }}" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">{{ __('Message') }}</label>
            <textarea id="message" name="message" rows="4" class="form-control" placeholder="{{ __('Your message') }}" required></textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
        </div>
    </form>
</section>
@endsection

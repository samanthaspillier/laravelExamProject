@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        @foreach ($faqs->groupBy('category') as $category => $faqsByCategory)
            <div class="col-md-10 mb-4">
                <h2 class="mb-4">{{ $category }}</h2> <!-- Display the category name -->

                @foreach ($faqsByCategory as $faq)
                    <div class="mb-3">
                        <div class="card shadow-sm border-light">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Question -->
                                    <h3 class="card-title mb-0" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}" aria-expanded="false" aria-controls="faq-{{ $faq->id }}">
                                        {{ $faq->question }}
                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}" aria-expanded="false" aria-controls="faq-{{ $faq->id }}">
                                            <i class="bi bi-chevron-down"></i>
                                        </button>
                                    </h3>
                                    @auth
                                    @if (auth()->user()->isAdmin())
                                        <a href="{{ route('editFaq', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @endauth
                                </div>

                                <!-- Answer -->
                                <div id="faq-{{ $faq->id }}" class="collapse mt-3">
                                    <p class="card-text">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        
        <!-- Contact Us link -->
        <div class="col-md-10 mb-4 text-center">
            <p>If you have a question that isn't covered here or have a suggestion for a new FAQ, please <a href="{{ route('contactForm') }}" class="btn btn-primary">contact us</a>.</p>
        </div>
        
        @auth
        @if (auth()->user()->isAdmin())
            <div class="text-center mt-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Add new question</a>
            </div>
        @endif
        @endauth     
    </div>
</div>

@endsection


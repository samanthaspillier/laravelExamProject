@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        @foreach ($faqs as $faq)
            <div class="col-md-8 mb-4 ">
                <div class="card shadow-sm border-light h-100">
                    <div class="card-body p-4 text-center">
                        <!-- Question -->
                        <h3 class="card-title mb-3">{{ $faq->question }}</h3>
                        
                        <!-- Answer -->
                        <p class="card-text">{{ $faq->answer }}</p>

                        @auth
                        @if (auth()->user()->isAdmin())
                                <a href="{{ route('editFaq', $faq->id) }}" class="btn btn-warning btn-sm mt-3">Edit</a>
                        @endif
                        @endauth                   
                    </div>
                </div>
            </div>
        @endforeach
        @auth
        @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning mt-3">Add new question</a>
        @endif
        @endauth     
    </div>
</div>
@endsection

@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')


@section('title', 'Malawian Tours News')
@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <!-- Grid for Posts -->
        @foreach($posts as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-light h-100">
                    <div class="card-body d-flex flex-column">
                        <!-- Centered Title -->
                        <h3 class="card-title text-center mb-2">{{ $post->title }}</h3>
                        @if ($post->cover_image)
                            <img src="{{ asset($post->cover_image) }}" class="img-fluid rounded mb-2" style="max-width: 100%; height: auto;" alt="{{ $post->title }}">
                        @endif

                        <!-- Display First Two Sentences of Content -->
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 150, '...') }}
                        </p>

                        <!-- Read More Button -->
                        @auth
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm mt-auto">Read more</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection

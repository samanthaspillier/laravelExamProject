@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title')
 {{ $post->title }}
@endsection

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Selected Post -->
            <div class="mb-4">
                <div class="text-muted mb-2">
                    {{ $post->published_at->format('j F Y') }}
                </div>
                <div class="clearfix">
                    @if ($post->cover_image)
                        <img src="{{ asset($post->cover_image) }}" class="img-fluid float-end me-3 mb-3" alt="Post Image" style="max-width: 50%; height: auto;">
                    @endif
                    <p class="card-text">
                        {{ $post->content }}
                    </p>
                </div>
               
            </div>

            <!-- Display Comments -->
            <div class="comments mb-4">
                <h3>Comments</h3>
                @if($post->comments->isNotEmpty())
                    @foreach($post->comments as $comment)
                        <div class="mb-3">
                            <strong>{{ $comment->user->name }}</strong> 
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            <p class="mb-0">{{ $comment->content }}</p>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p>No comments yet. Be the first to comment!</p>
                @endif
            </div>

            <!-- Comment Form -->
            @auth
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf

                    <!-- Hidden field for the post ID -->
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <div class="mb-3">
                        <label for="content" class="form-label">Add a Comment</label>
                        <textarea id="content" name="content" rows="2" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>

                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </div>
                </form>
            @endauth

        </div>
    </div>
</div>
@endsection

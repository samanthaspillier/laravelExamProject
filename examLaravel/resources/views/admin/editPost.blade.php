@extends('layouts.admin')
@section('title')
    {{ $post->exists ? 'Edit Post' : 'Create New Post' }}
@endsection

@section('content')
    <div class="container">

        <form action="{{ $post->exists ? route('updatePost', $post->id) : route('storePost') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($post->exists)
                @method('PUT')
            @endif

            <div class="row">
                <!-- Form Fields -->
                <div class="col-lg-8 col-md-12">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="form-label fw-bold">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cover_image" class="form-label fw-bold">Cover Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">
                    </div>
                </div>

                <!-- Cover Image Display -->
                <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center">
                    @if($post->cover_image)
                        <div class="mt-2">
                            <img src="{{ asset($post->cover_image) }}" alt="Cover Image" style="width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">{{ $post->exists ? 'Update Post' : 'Create Post' }}</button>
        </form>
        
        <div class="col-md-8 py-1">
                    @include('admin.partials.delete-post-form') 
            </div>
    </div>
@endsection

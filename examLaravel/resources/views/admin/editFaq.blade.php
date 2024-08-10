@extends('layouts.admin')

@section('title')
{{ $faq->exists ? 'Edit FAQ' : 'Create New FAQ' }}
@endsection


@section('content')
<div class="container">
    
<form action="{{ $faq->exists ? route('updateFaq', $faq->id) : route('storeFaq') }}" method="POST">
@csrf
@method('PUT')
    
    <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" id="question" name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question', $faq->question) }}" required>
        @error('question')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="answer" class="form-label">Answer</label>
        <textarea id="answer" name="answer" rows="4" class="form-control @error('answer') is-invalid @enderror" required>{{ old('answer', $faq->answer) }}</textarea>
        @error('answer')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Update FAQ</button>
    </div>
</form>
<div class="col-md-8 py-1">
                    @include('admin.partials.delete-faq-form') 
            </div>
                
</div>
@endsection

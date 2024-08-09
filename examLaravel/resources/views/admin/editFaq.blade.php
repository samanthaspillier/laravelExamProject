@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Edit FAQ Form -->
                    <form method="POST" action="{{ route('updateFaq', $faq->id) }}">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
    <label for="category" class="form-label">Category</label>
    <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" onchange="toggleNewCategoryInput()">
        <option value="">Select a category or write a new one</option>
        @foreach($categories as $category)
            @php
                $isSelected = (old('category') == $category->category || (isset($faq) && $faq->category == $category->category)) ? 'selected' : '';
                echo "<option value='{$category->category}' {$isSelected}>{$category->category}</option>";
            @endphp
        @endforeach
        <option value="new" {{ old('category') == 'new' ? 'selected' : '' }}>Other</option>
    </select>
    <input type="text" id="new_category" name="new_category" class="form-control mt-2" placeholder="Or enter a new category" value="{{ old('new_category') }}" style="display: none;">
    @error('category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<script>
    function toggleNewCategoryInput() {
        var categorySelect = document.getElementById('category');
        var newCategoryInput = document.getElementById('new_category');
        if (categorySelect.value === 'new') {
            newCategoryInput.style.display = 'block';
        } else {
            newCategoryInput.style.display = 'none';
        }
    }

    // Run on page load to check if 'Other' was selected before
    document.addEventListener("DOMContentLoaded", function() {
        toggleNewCategoryInput();
    });
</script>
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

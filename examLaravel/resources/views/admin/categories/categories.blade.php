@extends('layouts.admin')

@section('title', 'Manage FAQ Categories')

@section('content')
<div class="container">
    <h3>Manage FAQ Categories</h3>

    <div class="card mb-4">
        <div class="card-body">
            <!-- Dropdown to select a category to edit -->
            <div class="mb-3">
                <label for="categoryDropdown" class="form-label">Select a Category to Edit</label>
                <select id="categoryDropdown" class="form-select" onchange="window.location.href=this.value;">
                    <option value="">Select a category...</option>
                    @foreach($categories as $category)
                        <option value="{{ route('editCategory', $category->id) }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <a href="{{ route('createCategory') }}" class="btn btn-primary mt-3">Create New Category</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Manage FAQ Categories')

@section('content')
<div class="container">
    <h3>Manage FAQ Categories</h3>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('editCategory', '') }}" method="GET">
                <div class="mb-3">
                    <label for="category" class="form-label">Select a Category to Edit</label>
                    <select id="category" name="category" class="form-select" onchange="this.form.action = this.form.action.replace('__CATEGORY__', this.value); this.form.submit();">
                        <option value="">Select a category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <a href="{{ route('createCategory') }}" class="btn btn-primary mt-3">Create New Category</a>
        </div>
    </div>
</div>
@endsection

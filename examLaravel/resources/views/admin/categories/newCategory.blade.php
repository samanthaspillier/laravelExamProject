@extends('layouts.admin')

@section('title', 'Create New FAQ Category')

@section('content')
<div class="container">
    <h3>Create New FAQ Category</h3>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('storeCategory') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                    <a href="{{ route('admin.categories') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="container">



        <h1 class="mb-4 text-center">კატეგორიის ცვლილება</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">სახელი</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $category->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <label class="form-check-label" for="is_active">active</label>
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}>

            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">შეცვლა</button>
            </div>
        </form>

    </div>
@endsection

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

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="is_active">სტატუსი</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">შექმნა</button>
            </div>
        </form>

    </div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="container mt-4">
        <h1>Edit Product</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price (₾)</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="{{ old('price', $product->price / 100) }}" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ old('quantity', $product->quantity) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">Active</label>
                <input type="checkbox" id="is_active" name="is_active"
                    {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            </div>

            <div class="mb-3">
                <label for="is_featured" class="form-label">Featured</label>
                <input type="checkbox" id="is_featured" name="is_featured"
                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
            </div>

            <div class="mb-3">


                <label for="photos" class="form-label">Change Photos</label>
                <input type="file" class="form-control" id="photos" name="photos[]" multiple>

                @foreach ($product->photos as $photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $photo->href) }}" alt="{{ $product->name }}" width="150">
                        <label class="form-label">
                            <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}"> Delete
                        </label>
                        <label class="form-label">
                            <input type="radio" name="is_main" value="{{ $photo->id }}"
                                {{ $photo->is_main ? 'checked' : '' }}> Main
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection

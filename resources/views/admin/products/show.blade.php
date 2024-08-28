@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-6 col-md-12">
                <h1 class="display-4">{{ $product->name }}</h1>
                <p class="lead">{{ $product->description }}</p>
                <p class="h5 text-muted">Price: ${{ $product->price / 100 }}</p>
                <p class="h6 text-muted">Quantity: {{ $product->quantity }}</p>
                <p class="text-muted">
                    Category: <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                </p>
                <p class="text-success">{{ $product->is_featured ? 'Featured Product' : 'Regular Product' }}</p>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="swiper mySwiperClass" style='width:100%; height:300px;'>
                    <div class="swiper-wrapper">
                        @foreach ($product->photos as $photo)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $photo->href) }}" alt="{{ $photo->title }}"
                                    class="img-fluid rounded" style="object-fit: cover; height: 100%;">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary mt-4">Edit Product</a>
    </div>
@endsection

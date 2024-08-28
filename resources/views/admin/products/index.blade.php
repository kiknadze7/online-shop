@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Product List</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($product->photos->where('is_main', true)->first())
                            <img src="{{ asset('storage/' . $product->photos->where('is_main', true)->first()->href) }}"
                                class="card-img-top" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No photo">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text"><strong>{{ $product->price / 100 }}₾</strong></p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

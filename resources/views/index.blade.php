@extends('layouts.app')

@section('title', 'Main Page')

@section('content')
    <div class="container">
        <!-- Featured Products -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-3">Featured Products</h2>
                <div class="row">
                    @foreach ($featuredProducts as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if ($product->photos->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->photos->where('is_main', true)->first()->href) }}"
                                        class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="card-text">{{ $product->price / 100 }} ₾</p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="form-control mb-2">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="mb-3">All Products</h2>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if ($product->photos->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->photos->where('is_main', true)->first()->href) }}"
                                        class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="card-text">{{ $product->price / 100 }} ₾</p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="form-control mb-2">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

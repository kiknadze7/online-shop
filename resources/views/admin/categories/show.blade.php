@extends('layouts.app')

@section('title', 'Main Page')

@section('content')
    <div class="container">
        <h1 class="my-4">კატეგორიები და პროდუქტები</h1>

        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('categories.show', $category->id) }}">
                            <img src="{{ $category->image_url }}" class="card-img-top img-fluid" alt="{{ $category->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <a href="{{ route('categories.show', $category->id) }}"
                                    class="text-dark text-decoration-none">
                                    {{ $category->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Main Page')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">კატეგორიები და პროდუქტები</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">დასახელება</th>
                    <th scope="col">შექმნის თარიღი</th>
                    <th scope="col">სტატუსი</th>
                    <th scope="col">ედიტი</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>

                        <td class="align-middle">{{ $category->title }}</td>
                        <td class="align-middle">
                            <small class="text-muted">{{ $category->created_at->format('M d, Y') }}</small>
                        </td>
                        <td class="align-middle">
                            <div class="form-check form-switch">

                                {{ $category->is_active ? 'აქტიური' : 'ჩათიშული' }}
                            </div>
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                რედაქტირება
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Main Page')

@section('content')
    <div class="container">

        <h1 class="my-4">კატეგორიები და პროდუქტები</h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">კატეგორიების რაოდენობა</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-success">{{ $totalCategories }}</h2>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        @if (Route::has('categories.index'))
                            <a href="{{ route('categories.index') }}" class="btn"
                                style="background-color: #FF9900; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                                ნახვა
                            </a>
                        @endif
                        @if (Route::has('categories.create'))
                            <a href="{{ route('categories.create') }}" class="btn"
                                style="background-color: #345E50; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                                დამატება
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">პროდუქტების რაოდენობა</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-success">{{ $totalProductQuantity }}</h2>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        @if (Route::has('products.index'))
                            <a href="{{ route('products.index') }}" class="btn"
                                style="background-color: #FF9900; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                                ნახვა
                            </a>
                        @endif
                        @if (Route::has('products.create'))
                            <a href="{{ route('products.create') }}" class="btn"
                                style="background-color: #345E50; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                                დამატება
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <h1 class="my-4">მიმდინარე თვის შეჯამება</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">სულ შეკვეთების რაოდენობა</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-primary">{{ $ordersOfMonth }}</h2>
                    </div>
                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => '', 'date_from' => $startOfMonth, 'date_to' => $endOfMonth]) }}"
                            class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">წარმატებული შეკვეთები</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-success">{{ $completedOrdersOfMonth }}</h2>
                    </div>

                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => 'finished', 'date_from' => $startOfMonth, 'date_to' => $endOfMonth]) }}"
                            class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">წარმატებული შეკვეთების ფასი</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-success">{{ $totalCompletedOrdersPrice }}₾</h2>
                    </div>

                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => 'finished', 'date_from' => $startOfMonth, 'date_to' => $endOfMonth]) }}"
                            class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>
        </div>

        <h1 class="my-4">შეჯამება</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">მიმდინარე შეკვეთები</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-primary">{{ $currentOrdersCount }}</h2>
                    </div>

                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => 'new']) }}" class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">დადასტურებული შეკვეთები</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-primary">{{ $confirmedOrdersCount }}</h2>
                    </div>

                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => 'active']) }}" class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">წარმატებული შეკვეთები</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-success">{{ $completedOrdersCount }}</h2>
                    </div>

                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => 'finished']) }}" class="btn" class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">უარყოფილი შეკვეთები</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-danger">{{ $rejectedOrdersCount }}</h2>
                    </div>

                    @if (Route::has('orders.index'))
                        <a href="{{ route('orders.index', ['status' => 'rejected']) }}" class="btn"
                            style="background-color: #000000; color: white; padding: 4px 8px; border: none; border-radius: 4px;">
                            ნახვა
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

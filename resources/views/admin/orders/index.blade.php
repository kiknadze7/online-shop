@extends('layouts.app')

@section('title', 'Orders Page')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">შეკვეთები</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="GET" action="{{ route('orders.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Statuses</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="stale" {{ request('status') == 'stale' ? 'selected' : '' }}>Stale</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="date_from" class="form-control" placeholder="Date From"
                        value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date_to" class="form-control" placeholder="Date To"
                        value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID#</th>
                    <th scope="col">მომხმარებელი</th>
                    <th scope="col">კონტაქტი</th>
                    <th scope="col">პროდუქტების რაოდენობა</th>
                    <th scope="col">თარიღი</th>
                    <th scope="col">სტატუსი</th>
                    <th scope="col">ჯამი</th>
                    <th scope="col">ნახვა</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="align-middle">{{ $order->id }}</td>
                        <td class="align-middle">
                            <small class="text-muted">{{ $order->user->name ?? 'N/A' }}</small>
                        </td>
                        <td class="align-middle">{{ $order->contact_number }}</td>
                        <td class="align-middle">
                            {{ $order->cart->cartItems->count() }} პროდუქტი
                        </td>
                        <td class="align-middle">
                            <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                        </td>
                        <td class="align-middle">
                            <form id="status-form" action="{{ route('orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="submitForm()">
                                    <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Finished
                                    </option>
                                    <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                    <option value="stale" {{ $order->status == 'stale' ? 'selected' : '' }}>Stale</option>
                                </select>
                            </form>
                        </td>
                        <td class="align-middle">
                            <div class="form-check form-switch">
                                {{ $order->total_price / 100 }} ₾
                            </div>
                        </td>
                        <td class="align-middle">
                            <button class="btn btn-info btn-sm" type="button" data-bs-toggle="collapse"
                                data-bs-target="#orderDetails{{ $order->id }}" aria-expanded="false"
                                aria-controls="orderDetails{{ $order->id }}">
                                დეტალები
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="orderDetails{{ $order->id }}">
                        <td colspan="8">
                            <div class="card card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">პროდუქტი</th>
                                            <th scope="col">რაოდენობა</th>
                                            <th scope="col">ფასი</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->cart->cartItems as $item)
                                            <tr>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->product->price / 100 }} ₾</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                @if ($orders->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                            &laquo;
                        </a>
                    </li>
                @endif

                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($orders->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                            &raquo;
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitForm() {
        $.ajax({
            url: $('#status-form').attr('action'),
            type: 'POST',
            data: $('#status-form').serialize(),
            success: function(response) {
                if (response.success) {
                    alert('Status updated to ' + response.status);
                } else {
                    alert('Failed to update status');
                }
            },
            error: function() {
                alert('An error occurred');
            }
        });
    }
</script>

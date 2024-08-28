@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Order Details</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Order ID: {{ $order->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Customer:</h5>
                        <p>{{ $order->user->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Contact Number:</h5>
                        <p>{{ $order->contact_number }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Order Date:</h5>
                        <p>{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Status:</h5>
                        <form id="status-form" action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm" onchange="submitForm()">
                                <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Finished
                                </option>
                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                                <option value="stale" {{ $order->status == 'stale' ? 'selected' : '' }}>Stale</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Total Products:</h5>
                        <p>{{ $order->cart->cartItems->count() }} products</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Total Price:</h5>
                        <p>{{ $order->total_price / 100 }} ₾</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Products in Order</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->cart->cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->product->price / 100 }} ₾</td>
                                <td>{{ ($item->product->price * $item->quantity) / 100 }} ₾</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>
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

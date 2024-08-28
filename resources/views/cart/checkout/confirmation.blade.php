@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Order Confirmation</h2>

        <p>Thank you for your order!</p>
        <p>Order ID: {{ $order->id }}</p>
        <p>Total Price: {{ $order->total_price }} ₾</p>
        <p>Status: {{ $order->status }}</p>
        <p>Delivery Address: {{ $order->address }}</p>

        <a href="{{ route('index') }}" class="btn btn-primary">Back to Home</a>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Shopping Cart</h2>

        @if (empty($cartItems))
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->product->price / 100 }} ₾</td>
                            <td>{{ ($item->quantity * $item->product->price) / 100 }} ₾</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
    </div>
@endsection

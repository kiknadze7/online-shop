<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::id());
        $cart = $user->cart()->where('status', 'active')->first();

        if (!$cart) {
            return view('cart.index', [
                'cartItems' => [],
            ]);
        }

        $cartItems = $cart->cartItems()->get();

        return view('cart.index', [
            'cartItems' => $cartItems,
        ]);
    }

    public function add(Request $request)
    {
        $user = User::find(Auth::id());
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Validate the input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find or create the user's cart
        $cart = $user->cart()->firstOrCreate([
            'status' => 'active',
        ]);

        // Find the product
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        // Find or create the cart item
        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Update the quantity if the item already exists in the cart
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            // Create a new cart item if it doesn't exist
            $cart->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function checkout()
    {

        return view('cart.checkout.index');
    }
}

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

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $user->cart()->firstOrCreate([
            'status' => 'active',
        ]);

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
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

    public function remove($itemId)
    {
        $user = User::find(Auth::id());
        $cart = $user->cart()->where('status', 'active')->first();

        if (!$cart) {
            return redirect()->back()->withErrors('Cart not found.');
        }

        $cartItem = $cart->cartItems()->find($itemId);

        if (!$cartItem) {
            return redirect()->back()->withErrors('Cart item not found.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}

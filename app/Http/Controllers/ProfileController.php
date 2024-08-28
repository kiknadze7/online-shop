<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        return view('cart.checkout.index');
    }

    public function update(Request $request)
    {
        return view('cart.checkout.index');
    }
}

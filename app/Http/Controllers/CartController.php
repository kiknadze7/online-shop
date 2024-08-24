<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {

        return dd('cart index');
    }

    public function add(Request $request)
    {

        return dd('cart add');
    }

    public function update(Request $request)
    {

        return dd('cart update');
    }

    public function remove(Request $request)
    {

        return  dd('cart remove');
    }

    public function clear()
    {

        return dd('cart clear');
    }
}

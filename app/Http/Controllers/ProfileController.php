<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        return dd('profile index');
    }

    public function update(Request $request)
    {
        return dd('profile update');
    }
}

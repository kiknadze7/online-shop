<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminOrdersController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('cart.cartItems');

        $status = $request->input('status');
        if ($status && in_array($status, ['new', 'active', 'finished', 'rejected', 'stale'])) {
            $query->where('status', $status);
        }

        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $orders = $query->paginate(60);

        return view('admin.orders.index', [
            'orders' => $orders,
            'filters' => $request->all(),
        ]);
    }



    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        Cache::forget('summary');
        $request->validate([
            'status' => 'required|in:new,active,finished,rejected,stale',
        ]);
        $order->status = $request->input('status');
        $order->save();

        return response()->json([
            'success' => true,
            'status' => $order->status,
        ]);
    }
}

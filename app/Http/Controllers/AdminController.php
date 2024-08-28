<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index()
    {
        $summaryData = Cache::remember('summary', now()->addMinutes(30), function () {
            $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
            $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();

            $totalCategories = Category::count();
            $totalProductQuantity = Product::count();

            $ordersOfMonth = Order::whereBetween('created_at', [
                $startOfMonth,
                $endOfMonth
            ])->count();

            $completedOrdersOfMonth = Order::where('status', 'finished')
                ->whereBetween('created_at', [
                    $startOfMonth,
                    $endOfMonth
                ])->count();

            $totalCompletedOrdersPrice = Order::where('status', 'finished')
                ->whereBetween('created_at', [
                    $startOfMonth,
                    $endOfMonth
                ])->sum('total_price');

            $totalCompletedOrdersPrice  = $totalCompletedOrdersPrice / 100;
            $currentOrdersCount = Order::where('status', 'new')->count();
            $confirmedOrdersCount = Order::where('status', 'active')->count();
            $completedOrdersCount = Order::where('status', 'finished')->count();
            $rejectedOrdersCount = Order::where('status', 'rejected')->count();

            return [
                'totalCategories' => $totalCategories,
                'totalProductQuantity' => $totalProductQuantity,
                'completedOrdersOfMonth' => $completedOrdersOfMonth,
                'ordersOfMonth' => $ordersOfMonth,
                'totalCompletedOrdersPrice' => $totalCompletedOrdersPrice,
                'currentOrdersCount' => $currentOrdersCount,
                'confirmedOrdersCount' => $confirmedOrdersCount,
                'completedOrdersCount' => $completedOrdersCount,
                'rejectedOrdersCount' => $rejectedOrdersCount,
                "startOfMonth" => $startOfMonth,
                "endOfMonth" => $endOfMonth
            ];
        });

        return view('admin.index', $summaryData);
    }
}

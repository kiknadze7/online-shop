<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class CheckForStaleOrders extends Command
{
    protected $signature = 'app:check-for-stale-orders';
    protected $description = 'სტატუსის ცვლილება ძველ აითემზე';

    public function handle()
    {
        $twoDaysAgo = Carbon::now()->subDays(2);

        $orders = Order::where('status', 'new')
            ->where('created_at', '<', $twoDaysAgo)
            ->get();

        foreach ($orders as $order) {
            $order->status = 'stale';
            $order->save();
            $this->info("Order ID {$order->id} has been updated to 'stale'.");
        }

        $this->info('All applicable orders have been updated.');
    }
}

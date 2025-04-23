<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tire;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        $data['header_title'] = 'Admin Dashboard';

        // Low stock tires
        $data['lowStockList'] = Tire::whereColumn('quantite', '<=', 'low_stock_threshold')
            ->orderBy('quantite')
            ->take(5)
            ->get();

        // Order stats
        $data['totalOrders'] = Order::count();
        $data['totalSales'] = Order::where('status', '!=', 'cancelled')->sum('total');

        $data['pendingOrders'] = Order::where('status', 'pending')->count();
        $data['shippedOrders'] = Order::where('status', 'shipped')->count();
        $data['deliveredOrders'] = Order::where('status', 'delivered')->count();
        $data['cancelledOrders'] = Order::where('status', 'cancelled')->count();

        // Growth calculations
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        // 🔥 Order Growth
        $currentMonthOrders = Order::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonthOrders = Order::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        if ($lastMonthOrders > 0) {
            $orderGrowth = round((($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 2);
        } else {
            $orderGrowth = $currentMonthOrders > 0 ? 100 : 0;
        }

        // 💶 Sales Growth
        $currentMonthSales = Order::where('status', '!=', 'cancelled')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('total');

        $lastMonthSales = Order::where('status', '!=', 'cancelled')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total');

        if ($lastMonthSales > 0) {
            $salesGrowth = round((($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100, 2);
        } else {
            $salesGrowth = $currentMonthSales > 0 ? 100 : 0;
        }

        $data['orderGrowth'] = $orderGrowth;
        $data['salesGrowth'] = $salesGrowth;

        return view('admin.index', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tire;
use App\Models\Order;
use App\Models\OrderItem;
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

        // 🔥 Monthly Growth Calculations
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        // Order Growth
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

        // Sales Growth
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

        // 🔥 Daily Sales Summary
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $data['ordersToday'] = Order::whereDate('created_at', $today)->count();
        $data['salesToday'] = Order::whereDate('created_at', $today)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $salesYesterday = Order::whereDate('created_at', $yesterday)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        if ($salesYesterday > 0) {
            $dailySalesGrowth = round((($data['salesToday'] - $salesYesterday) / $salesYesterday) * 100, 2);
        } else {
            $dailySalesGrowth = $data['salesToday'] > 0 ? 100 : 0;
        }

        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // 🗓 Weekly Stats
        $data['ordersThisWeek'] = Order::whereDate('created_at', '>=', $startOfWeek)->count();
        $data['salesThisWeek'] = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $startOfWeek)
            ->sum('total');

        // 📈 Weekly Growth Calculation
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        $weeklySalesLast = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('total');

        $weeklySalesCurrent = $data['salesThisWeek'];

        if ($weeklySalesLast > 0) {
            $weeklyGrowth = round((($weeklySalesCurrent - $weeklySalesLast) / $weeklySalesLast) * 100, 2);
        } else {
            $weeklyGrowth = $weeklySalesCurrent > 0 ? 100 : 0;
        }

        $data['weeklyGrowth'] = $weeklyGrowth;

        // 🗓 Monthly Stats
        $data['ordersThisMonth'] = $currentMonthOrders;
        $data['salesThisMonth'] = $currentMonthSales;

        // 🔥 Best Selling Tires
        $bestSellingTires = OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('tire') // Make sure relation exists
            ->get()
            ->map(function ($item) {
                $tire = Tire::find($item->product_id);
                $item->tire_size = $tire?->tire_size ?? '-';
                $item->marque = $tire?->marque ?? '-';
                return $item;
            });

        $data['bestSellingTires'] = $bestSellingTires;

        // Final stats
        $data['orderGrowth'] = $orderGrowth;
        $data['salesGrowth'] = $salesGrowth;
        $data['dailySalesGrowth'] = $dailySalesGrowth;

        return view('admin.index', $data);
    }
}

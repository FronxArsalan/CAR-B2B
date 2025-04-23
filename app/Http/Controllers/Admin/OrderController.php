<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter by status (optional)
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // 🔍 Search by order ID or customer info
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        $order->load('items.tire');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated.');
    }
    public function invoice(Order $order)
    {
        $order->load('items.tire');

        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));

        return $pdf->download('invoice_order_' . $order->id . '.pdf');
    }
}

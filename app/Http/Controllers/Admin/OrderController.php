<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Order::with('user');
        
        if ($user->role == 'user') {
            $query->where('user_id', $user->id);
        }
    
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }
    
        $orders = $query->latest()->get(); // ✅ Now this works: fetches all, ordered by latest

    
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

        Mail::to($order->email)->send(new OrderStatusUpdatedMail($order));

        return back()->with('success', 'Order status updated.');
    }
    public function invoice(Order $order)
    {
        $order->load('items.tire');

        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));

        return $pdf->download('invoice_order_' . $order->id . '.pdf');
    }
}

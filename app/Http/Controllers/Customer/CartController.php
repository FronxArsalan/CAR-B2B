<?php

namespace App\Http\Controllers\Customer;

use App\Models\Tire;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    //
    public function index()
    {
        $items = CartItem::with('tire')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn($item) => $item->price * $item->quantity);
        return view('customer.cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Tire $tire)
    {
        $cartItem = CartItem::firstOrNew([
            'user_id' => Auth::id(),
            'tire_id' => $tire->id,
        ]);
        
        $cartItem->quantity += $request->input('quantity', 1);
        $cartItem->price = $tire->getDiscountedPrice($request->quantity);

        $cartItem->save();

        return back()->with('success', 'Tire added to cart!');
    }

    public function update(Request $request, Tire $tire)
    {
        CartItem::where('user_id', Auth::id())
            ->where('tire_id', $tire->id)
            ->update(['quantity' => $request->input('quantity', 1)]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Tire $tire)
    {
        CartItem::where('user_id', Auth::id())
            ->where('tire_id', $tire->id)
            ->delete();

        return back()->with('success', 'Item removed.');
    }

    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Cart cleared.');
    }
    public function count()
    {
        $count = CartItem::where('user_id', Auth::id())->count();
        return response()->json(['count' => $count]);
    }


    // checkout
    public function checkout()
    {
        $userId = Auth::id();
        $items = CartItem::with('tire')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn($item) => $item->price * $item->quantity);
         // Get the most recent order of the logged-in user
        $previousOrder = Order::where('user_id', $userId)->latest()->first();

        return view('customer.cart.checkout', compact('items', 'total' , 'previousOrder'));
    }


    // place_order
    public function placeOrder(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zip' => 'required|string',
            'shipping_country' => 'required|string',
            'billing_address' => 'required|string',
            'billing_city' => 'required|string',
            'billing_state' => 'required|string',
            'billing_zip' => 'required|string',
            'billing_country' => 'required|string',
            'payment_method' => 'required|string',
        ]);
        
        // dd($request->all());
        // Get user and cart data
        $userId = Auth::id();
        $cartItems = CartItem::where('user_id', $userId)->get();


    
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }
        DB::transaction(function () use ($request, $userId, $cartItems) {
            // Create order using object method
            $order = new Order();
            $order->user_id = $userId;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->shipping_address = $request->shipping_address;
            $order->shipping_city = $request->shipping_city;
            $order->shipping_state = $request->shipping_state;
            $order->shipping_zip = $request->shipping_zip;
            $order->shipping_country = $request->shipping_country;
            $order->billing_address = $request->billing_address;
            $order->billing_city = $request->billing_city;
            $order->billing_state = $request->billing_state;
            $order->billing_zip = $request->billing_zip;
            $order->billing_country = $request->billing_country;
            $order->payment_method = $request->payment_method;
            $order->total = $cartItems->sum(fn($item) => $item->price * $item->quantity);
            $order->status = 'pending';
            $order->save(); // Save the order
        
            foreach ($cartItems as $item) {
                // dd($item);
                if (!$item->tire_id) {
                    return back()->with('error', 'One or more items in your cart are missing product information.');
                }
            
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->tire_id;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $item->price;
                $orderItem->save();
            }
        
            // Clear user's cart
            CartItem::where('user_id', $userId)->delete();

            Mail::to($order->email)->send(new OrderPlacedMail($order));

            Log::info('Order placed successfully for user ID: ' . $userId);
        });
    
        return redirect()->route('tires.search')->with('success', 'Your order has been placed successfully!');
    }
}

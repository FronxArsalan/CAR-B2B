<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Tire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

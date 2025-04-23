<h2>Thanks for your order, {{ $order->name }}!</h2>
<p>Your order #{{ $order->id }} has been placed successfully.</p>
<p>Total: €{{ number_format($order->total, 2) }}</p>
<p>Status: {{ ucfirst($order->status) }}</p>

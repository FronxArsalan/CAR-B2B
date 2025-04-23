<h2>Hi {{ $order->name }},</h2>
<p>Your order #{{ $order->id }} status has been updated.</p>
<p><strong>New Status:</strong> {{ ucfirst($order->status) }}</p>
<p>Thank you for shopping with us!</p>

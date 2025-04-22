<?php

namespace App\Notifications;

use App\Models\Tire;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LowStockNotification extends Notification
{
    use Queueable;

    
    public function __construct(public Tire $tire)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Low Stock Alert: ' . $tire->nr_article)
            ->line("Tire {$tire->marque} {$tire->nr_article} is low on stock.")
            ->line("Current stock: {$tire->quantite}")
            ->action('Restock Now', url("/admin/tires/{$tire->id}/edit"));
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => "Low stock alert for {$tire->nr_article}",
            'tire_id' => $tire->id,
            'current_stock' => $tire->quantite
        ];
    }
}
<div style="max-width: 600px; margin: 30px auto; padding: 30px; background: #e9f6fc; border: 1px solid #cde5f1; border-radius: 8px; font-family: Arial, sans-serif; color: #333;">

    {{-- Header with Logo --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/images/logo-removebg_1.png') }}" alt="Logo" style="max-width: 180px; height: auto;">
    </div>

    {{-- Heading --}}
    <h2 style="color: #2196F3; font-size: 24px; margin-bottom: 20px;">
        Support Ticket Submitted
    </h2>

    {{-- Message --}}
    <p style="font-size: 16px; margin-bottom: 15px;">
        Your support ticket has been submitted successfully.
    </p>

    {{-- Ticket ID --}}
    <p style="font-size: 16px; margin-bottom: 20px;">
        <strong>Ticket ID:</strong> 
        <a href="{{ $ticketLink }}" style="color: #2196F3; text-decoration: none;">
            #{{ $ticket->ticket_id }}
        </a>
    </p>

    {{-- Instruction --}}
    <p style="font-size: 16px;">
        You can view your ticket by clicking the link above. Our support team will get back to you shortly.
    </p>

    {{-- CTA Button --}}
    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ $ticketLink }}" style="background-color: #2196F3; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-size: 16px;">
            View My Ticket
        </a>
    </div>
</div>

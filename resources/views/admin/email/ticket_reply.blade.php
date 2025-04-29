<!-- resources/views/emails/ticket_reply.blade.php -->

<div style="max-width: 600px; margin: 30px auto; padding: 30px; background: #e9f6fc; border: 1px solid #cde5f1; border-radius: 8px; font-family: Arial, sans-serif; color: #333;">

    {{-- Header with Logo --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/images/logo-removebg_1.png') }}" alt="Logo" style="max-width: 180px; height: auto;">
    </div>

    {{-- Heading --}}
    <h2 style="color: #2196F3; font-size: 22px; margin-bottom: 20px;">
        New Reply on Your Support Ticket
    </h2>

    {{-- New Reply Message --}}
    <p style="font-size: 16px; margin-bottom: 10px;">
        There is a new reply on your support ticket.
    </p>

    {{-- Ticket Subject --}}
    <p style="font-size: 16px; margin-bottom: 10px;">
        <strong>Ticket Subject:</strong> {{ $ticket->subject }}
    </p>

    {{-- Actual Reply --}}
    <p style="font-size: 16px; margin-bottom: 20px;">
        <strong>Reply:</strong><br>
        <span style="display: inline-block; background-color: #f1f1f1; padding: 10px 15px; border-radius: 6px;">
            {{ $reply->reply }}
        </span>
    </p>

    {{-- Instruction --}}
    <p style="font-size: 16px; margin-bottom: 30px;">
        You can view the full conversation and respond by clicking the link below:
    </p>

    {{-- CTA Button --}}
    <div style="text-align: center;">
        <a href="{{ $ticketLink }}" style="display: inline-block; background-color: #2196F3; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px;">
            View Ticket
        </a>
    </div>
</div>

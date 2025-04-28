<!-- resources/views/emails/ticket_reply.blade.php -->

<p>There is a new reply on the support ticket.</p>

<p><strong>Ticket Subject:</strong> {{ $ticket->subject }}</p>

<p><strong>Reply:</strong> {{ $reply->reply }}</p>

<p>You can view the full ticket and reply here: <a href="{{ $ticketLink }}">View Ticket</a></p>

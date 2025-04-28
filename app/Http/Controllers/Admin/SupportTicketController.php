<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SupportTicketController extends Controller
{
    public function index()
    {
        // Admin ko sab tickets dikhao
        $tickets = SupportTicket::latest()->get();
        return view('admin.support.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'ticket_id' => 'nullable',
        ]);


        $ticket = SupportTicket::create([
            'user_id' => auth()->id(),
            'ticket_id' => strtoupper(Str::random(6)), // <-- yeh add karo
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

      // User ko email bhejna
    $ticketLink = route('support.show', $ticket->ticket_id);

    Mail::send('admin.email.support_ticket', ['ticket' => $ticket, 'ticketLink' => $ticketLink], function ($message) {
        $message->to(auth()->user()->email)
            ->subject('Support Ticket Submitted');
    });

        return redirect()->route('support.create')->with('success', 'Ticket submitted successfully.');
    }
    public function show($ticket_id)
    {
        $ticket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();
        $replies = $ticket->replies()->with('user')->orderBy('created_at', 'asc')->get();
    
        return view('admin.support.show', compact('ticket', 'replies'));
    }
    

    public function reply(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $reply = TicketReply::create([
            'ticket_id' => $ticket->ticket_id,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        $ticket->update(['status' => 'In Progress']);

        // Check karein reply kisne diya hai: Admin ya User
        if (auth()->user()->role === 'admin') {
            // Admin ne reply diya -> User ko email bhejein
            $userEmail = $ticket->user->email; // Ticket banane wale user ka email
            $ticketLink = route('support.show', $ticket->ticket_id);

            Mail::send('admin.email.ticket_reply', [
                'ticket' => $ticket,
                'reply' => $reply,
                'ticketLink' => $ticketLink,
            ], function ($message) use ($userEmail) {
                $message->to($userEmail)
                    ->subject('Reply to Your Support Ticket');
            });
        } else {
            // User ne reply diya -> Admin ko email bhejein
            $adminEmail = 'ahmedshahid14aug@gmail.com'; // <-- yahan apna admin ka email daalo
            $ticketLink = route('support.show', $ticket->ticket_id); // admin panel ka link dena hai

            Mail::send('admin.email.ticket_reply', [
                'ticket' => $ticket,
                'reply' => $reply,
                'ticketLink' => $ticketLink,
            ], function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                    ->subject('New Reply on Support Ticket');
            });
        }

        return back()->with('success', 'Reply sent successfully.');
    }

}


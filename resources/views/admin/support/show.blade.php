@extends('include.dashboard-layout')

@section('dashboard-content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h4 class="page-title mb-0">Support Ticket Details</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Support</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ticket Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ticket Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6><strong>Subject:</strong> {{ $ticket->subject }}</h6>
                        </div>
                        <div class="mb-3">
                            <p><strong>Description:</strong> {{ $ticket->message }}</p>
                        </div>
                        <div class="text-muted small">
                            Created at: {{ $ticket->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Conversation</h5>
                    </div>
                    <div class="card-body">
                        @if ($replies->count() > 0)
                            @foreach ($replies as $reply)
                                <div class="border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>{{ $reply->user->name }}</strong>
                                        <small class="text-muted">{{ $reply->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                    <p class="mb-0">{{ $reply->reply }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No replies yet.</p>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Send a Reply</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('support.reply', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="reply" class="form-label">Your Message</label>
                                <textarea name="reply" id="reply" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Send Reply</button>
                        </form>
                    </div>
                </div>

            </div> <!-- container -->
        </div> <!-- content -->
    </div> <!-- content-page -->
@endsection

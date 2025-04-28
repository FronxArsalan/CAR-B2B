@extends('include.dashboard-layout')

@section('dashboard-content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                            <h4 class="page-title">Create Support Ticket</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Customer Support</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Create Support Ticket</h4>
                                </div>

                                <form action="{{ route('support.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Message</label>
                                        <textarea name="message" class="form-control" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit Ticket</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

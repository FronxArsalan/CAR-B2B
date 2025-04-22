{{-- // resources/views/tires/edit.blade.php --}}
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
                            <h4 class="page-title">Starter</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Jidox</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Starter</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Tire</h4>
                                </div>

                                <form action="{{ route('tires.update', $tire->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        @include('admin.tires.partials.form', ['tire' => $tire])
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
   @include('admin.tires.partials.scripts')
@endsection

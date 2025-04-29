@extends('include.dashboard-layout')
@section('dashboard-content')
<style>
    div.dataTables_wrapper div.dataTables_filter label{
        text-align: end !important;
    }
    #basic-datatable_wrapper .col-sm-12{
        overflow: auto;
    }
</style>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">     
                            <h4 class="page-title">User List</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">List</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">User List</h4>
                                    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Add New User</a>
                                </div>
                                @include('message')
                            

                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Full Name</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                            <th>Register at</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($users as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->user_name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone_no}}</td>
                                            <td>{{$item->role}}</td>
                                            <td>{{ optional($item->created_at)->format('Y-m-d') ?? 'N/A' }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            

                                            <td class="d-flex gap-2">
                                                <a href="{{route('user.edit',$item->id)}}" class="btn btn-primary btn-sm" >Edit</a>
                                                
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>

                                                <form action="{{ route('user.status', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        {{ $item->status == 1 ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                        @endforeach


                                       
                                        </tr>
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div> <!-- end row-->
            </div>
        <!-- container -->

    </div>
    <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>document.write(new Date().getFullYear())</script> © Jidox - Coderthemes.com
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-md-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>
@endsection

{{-- // resources/views/tires/index.blade.php --}}
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
                            <h4 class="page-title">Products</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                                <li class="breadcrumb-item active">list</li>
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
                                    <h4 class="card-title">Tire List</h4>
                                    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New
                                        Product</a>
                                </div>


                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Size</th>
                                                <th>Type</th>
                                                <th>Season</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th width="150">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->brand }}</td>
                                                    <td>{{ $product->size }}</td>
                                                    <td>{{ $product->type }}</td>
                                                    <td>{{ $product->season }}</td>
                                                    <td>${{ $product->price }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="{{ route('products.destroy', $product->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf @method('DELETE')
                                                            <button onclick="return confirm('Delete this product?')"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">No products found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

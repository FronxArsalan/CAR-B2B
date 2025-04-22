{{-- resources/views/admin/tires/inventory.blade.php --}}
@extends('include.dashboard-layout')
@section('dashboard-content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Inventory Management</h4>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card widget-flat bg-primary text-white">
                            <div class="card-body">
                                <h5 class="text-white">Total Items</h5>
                                <h2>{{ $stockSummary->total_items }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card widget-flat bg-success text-white">
                            <div class="card-body">
                                <h5 class="text-white">Total Stock</h5>
                                <h2>{{ $stockSummary->total_stock }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card widget-flat bg-warning text-white">
                            <div class="card-body">
                                <h5 class="text-white">Low Stock Items</h5>
                                <h2>{{ $stockSummary->low_stock_count }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Low Stock Alert (Below 5)</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Article #</th>
                                            <th>Brand</th>
                                            <th>Size</th>
                                            <th>Current Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lowStock as $tire)
                                            <tr>
                                                <td>{{ $tire->nr_article }}</td>
                                                <td>{{ $tire->marque }}</td>
                                                <td>{{ $tire->largeur }}/{{ $tire->hauteur }}R{{ $tire->diametre }}</td>
                                                <td class="text-danger fw-bold">{{ $tire->quantite }}</td>
                                                <td>
                                                    <a href="{{ route('tires.edit', $tire->id) }}" 
                                                       class="btn btn-sm btn-primary">Restock</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
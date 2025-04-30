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
                            <h4 class="page-title">Tires</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tires</a></li>
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
                                    <div>
                                        <a href="{{ route('google-sheet.create') }}" class="btn btn-primary mb-3">Add New Tire</a>
                                        {{-- <a href="{{ route('tires.import.form') }}" class="btn btn-secondary mb-3">Import
                                            CSV</a>

                                        <a href="{{ route('fetch-google-sheet') }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-info mb-3">Manual Sync</a> --}}
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Article #</th>
                                                <th>Brand</th>
                                                <th>Profile</th>
                                                <th>Type</th>
                                                <th>Tire Size</th>
                                                <th>Speed</th>
                                                <th>Season</th>
                                                <th>DOT</th>
                                                <th>RunFlat</th>
                                                <th>Condition</th>
                                                <th>Stock</th>
                                                <th>Wholesale (€)</th>
                                                <th>Retail (€)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tires as $tire)
                                                <tr>
                                                    <td>{{ $tire['nr_article'] }}</td>
                                                    <td>{{ $tire['marque'] }}</td>
                                                    <td>{{ $tire['profile'] }}</td>
                                                    <td>{{ $tire['type'] ?? '-' }}</td>
                                                    <td>{{ $tire['largeur'] }}/{{ $tire['hauteur'] }}R{{ $tire['diametre'] }}
                                                    </td>
                                                    <td>{{ $tire['vitesse'] }}</td>
                                                    <td>{{ ucfirst($tire['saison']) }}</td>
                                                    <td>{{ $tire['dot'] ?? '-' }}</td>
                                                    <td>{{ $tire['rft'] ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $tire['etat'] }}</td>
                                                    <td class="{{ $tire['quantite'] < 5 ? 'text-danger fw-bold' : '' }}">
                                                        {{ $tire['quantite'] }}
                                                        @if ($tire['quantite'] < 5)
                                                            <span class="badge bg-danger ms-1">Low</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ is_numeric(preg_replace('/[^\d.]/', '', $tire['prix_pro']))
                                                            ? number_format((float) preg_replace('/[^\d.]/', '', $tire['prix_pro']), 2)
                                                            : '-' }}
                                                    </td>

                                                    <td>
                                                        {{ is_numeric(preg_replace('/[^\d.]/', '', $tire['prix']))
                                                            ? number_format((float) preg_replace('/[^\d.]/', '', $tire['prix']), 2)
                                                            : '-' }}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route('google-sheet.edit', $tire['ID']) }}"
                                                                class="btn btn-sm btn-warning me-2">
                                                                <i class="ri-pencil-fill"></i>
                                                            </a>

                                                            <form action="{{ route('google-sheet.destroy', $tire['ID']) }}"
                                                                method="POST" class="m-0">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger m-0"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    <i class="ri-delete-bin-6-fill"></i>
                                                                </button>
                                                            </form>
                                                        </div>

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
    </div>
@endsection

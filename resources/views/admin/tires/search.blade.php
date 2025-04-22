@extends('include.dashboard-layout')
@section('dashboard-content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12" style="padding: 0px;">
                        <div
                            class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                            <h4 class="page-title rp-page-title">Recherche Rapide</h4>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>



                <div class="row">

                    <div class="form-container">
                        <form action="{{ route('tires.search') }}" method="GET" class="d-flex flex-wrap gap-2">
                            <div class="form-group" id="taille-group">
                                <label for="taille">Taille / Code Produit</label>
                                <input type="text" name="tire_size" id="taille" value="{{ request('tire_size') }}"
                                    placeholder="P. ex. 205/55R16 ou 2055516" class="form-control">
                            </div>

                            <div class="form-group" id="marque-group">
                                <label for="marque">Marque</label>
                                <input type="text" name="mark" id="marque" value="{{ request('mark') }}"
                                    placeholder="Marque" class="form-control">
                            </div>

                            <div class="form-group align-self-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('tires.search') }}" class="btn btn-success mt-1">Reset</a>
                            </div>
                        </form>

                    </div>
                    <div class="col-xl-12 my-col-xl-12">

                        <div class="card my-col-xl-12">

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                        <thead class="border-top border-bottom bg-light-subtle border-light">
                                            <tr>
                                                {{-- <th class="py-1">Type</th>
                                                    <th class="py-1">Saison</th>
                                                    <th class="py-1">Marque</th>
                                                    <th class="py-1">Taille</th>
                                                    <th class="py-1">LI</th>
                                                    <th class="py-1">SI</th>
                                                    <th class="py-1">Profile</th>
                                                    <th class="py-1">Label</th>
                                                    <th class="py-1">Stock</th>
                                                    <th class="py-1">Retail</th>
                                                    <th class="py-1">Remise</th>
                                                    <th class="py-1">Envoi Camion</th>
                                                    <th class="py-1">Vente</th>
                                                    <th class="py-1">Commande</th> --}}
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
                                                    <td>{{ $tire->nr_article }}</td>
                                                    <td>{{ $tire->marque }}</td>
                                                    <td>{{ $tire->profile }}</td>
                                                    <td>{{ $tire->type ?? '-' }}</td>
                                                    <td>{{ $tire->largeur }}/{{ $tire->hauteur }}R{{ $tire->diametre }}
                                                    </td>
                                                    <td>{{ $tire->vitesse }}</td>
                                                    <td>{{ ucfirst($tire->saison) }}</td>
                                                    <td>{{ $tire->dot ?? '-' }}</td>
                                                    <td>{{ $tire->rft ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $tire->etat }}</td>
                                                    <td class="{{ $tire->quantite < 5 ? 'text-danger fw-bold' : '' }}">
                                                        {{ $tire->quantite }}
                                                        @if ($tire->quantite < 5)
                                                            <span class="badge bg-danger ms-1">Low</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ number_format($tire->prix_pro, 2) }}</td>
                                                    <td>{{ number_format($tire->prix, 2) }}</td>
                                                    <td>
                                                        <div class="">


                                                            <form action="{{ route('cart.add', $tire->id) }}"
                                                                method="POST" class="m-0">
                                                                @csrf
                                                                <input type="number" name="quantity" value="1"
                                                                    min="1" style="width: 60px;"
                                                                    class="form-control form-control-sm">
                                                                <button type="submit" class="btn btn-sm btn-primary m-0">
                                                                    <i class="ri-shopping-cart-line"></i>
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
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Jidox - Coderthemes.com
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

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
@endsection

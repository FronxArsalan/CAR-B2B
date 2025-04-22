@extends('include.dashboard-layout')
@section('dashboard-content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @if ($lowStockTires->count())
                    <div class="alert alert-warning">
                        <strong>⚠️ Low Stock Alert</strong>
                        <ul>
                            @foreach ($lowStockTires as $tire)
                                <li>{{ $tire->tire_size }} ({{ $tire->marque }}) — Only {{ $tire->quantite }} left</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="alert alert-success">All tires are sufficiently stocked ✅</div>
                @endif


              

             

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

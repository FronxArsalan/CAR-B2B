</div>
<!-- END wrapper -->

<!-- Theme Settings -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="text-white m-0">Theme Settings</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="card mb-0 p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                </div>

                <h5 class="mt-0 fs-16 fw-bold mb-3">Choose Layout</h5>
                <div class="d-flex flex-column gap-2">
                    <div class="form-check form-switch">
                        <input id="customizer-layout01" name="data-layout" type="checkbox" value="vertical"
                            class="form-check-input">
                        <label class="form-check-label" for="customizer-layout01">Vertical</label>
                    </div>
                    <div class="form-check form-switch">
                        <input id="customizer-layout02" name="data-layout" type="checkbox" value="horizontal"
                            class="form-check-input">
                        <label class="form-check-label" for="customizer-layout02">Horizontal</label>
                    </div>
                </div>

                <h5 class="my-3 fs-16 fw-bold">Color Scheme</h5>

                <div class="d-flex flex-column gap-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light"
                            value="light">
                        <label class="form-check-label" for="layout-color-light">Light</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark"
                            value="dark">
                        <label class="form-check-label" for="layout-color-dark">Dark</label>
                    </div>
                </div>

                <div id="layout-width">
                    <h5 class="my-3 fs-16 fw-bold">Layout Mode</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                id="layout-mode-fluid" value="fluid">
                            <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                        </div>

                        <div id="layout-boxed">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                    id="layout-mode-boxed" value="boxed">
                                <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                            </div>
                        </div>

                        <div id="layout-detached">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                    id="data-layout-detached" value="detached">
                                <label class="form-check-label" for="data-layout-detached">Detached</label>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="my-3 fs-16 fw-bold">Topbar Color</h5>

                <div class="d-flex flex-column gap-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light"
                            value="light">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-dark"
                            value="dark">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-topbar-color"
                            id="topbar-color-brand" value="brand">
                        <label class="form-check-label" for="topbar-color-brand">Brand</label>
                    </div>
                </div>

                <div>
                    <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                id="leftbar-color-light" value="light">
                            <label class="form-check-label" for="leftbar-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                id="leftbar-color-dark" value="dark">
                            <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                id="leftbar-color-brand" value="brand">
                            <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                        </div>
                    </div>
                </div>

                <div id="sidebar-size">
                    <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-default" value="default">
                            <label class="form-check-label" for="leftbar-size-default">Default</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-compact" value="compact">
                            <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-small" value="condensed">
                            <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-small-hover" value="sm-hover">
                            <label class="form-check-label" for="leftbar-size-small-hover">Hover View</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-full" value="full">
                            <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-fullscreen" value="fullscreen">
                            <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen Layout</label>
                        </div>
                    </div>
                </div>

                <div id="layout-position">
                    <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                    <div class="btn-group checkbox" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position"
                            id="layout-position-fixed" value="fixed">
                        <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position"
                            id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-soft-primary w-sm ms-0"
                            for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>

                <div id="sidebar-user">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <label class="fs-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="sidebar-user"
                                id="sidebaruser-check">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
            </div>
            <div class="col-6">
                <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
 <!-- Datatables js -->
 <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
 <!-- Datatable Demo Aapp js -->
 <script src="{{ asset('assets/js/pages/demo.datatable-init.js')}}"></script>


<!-- Daterangepicker js -->
<script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

<!-- Apex Charts js -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector Map js -->
<script src="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
</script>

<!-- Dashboard App js -->
<script src="{{ asset('assets/js/pages/demo.dashboard.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- <script src="assets/js/app.js"></script> -->
<script>
    const brands = ["Michelin", "Goodyear", "Bridgestone", "Pirelli", "Continental", "Dunlop"];

    const marqueInput = document.getElementById('marque');
    const dropdown = document.getElementById('dropdown');

    // When user types in Marque input
    marqueInput.addEventListener('input', () => {
        const query = marqueInput.value.toLowerCase();
        dropdown.innerHTML = '';

        const filteredBrands = brands.filter(brand => brand.toLowerCase().includes(query));

        if (filteredBrands.length === 0) {
            const noResult = document.createElement('div');
            noResult.className = 'no-results';
            noResult.textContent = 'No search found';
            dropdown.appendChild(noResult);
        } else {
            filteredBrands.forEach(brand => {
                const option = document.createElement('div');
                option.className = 'dropdown-item';
                option.textContent = brand;
                option.onclick = () => {
                    marqueInput.value = brand;
                    dropdown.style.display = 'none';
                };
                dropdown.appendChild(option);
            });
        }

        dropdown.style.display = 'block';
    });

    // Hide dropdown if clicking outside of marque input or dropdown
    document.addEventListener('click', function(event) {
        const isClickInside = marqueInput.contains(event.target) || dropdown.contains(event.target);
        if (!isClickInside) {
            dropdown.style.display = 'none';
        }
    });
</script>
@yield('scripts')
<!-- Bootstrap JS and dependencies -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>

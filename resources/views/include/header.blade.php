<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Jidox - Material Design Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Datatables css -->
    <link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />


    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">

    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://kit.fontawesome.com/854ddac0b3.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{ route('dashboard') }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="{{ route('dashboard') }}" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="ri-menu-2-fill"></i>
                    </button>

                    <div>

                        @if (Auth::user()->role == 'user')
                            <a href="{{ route('cart.index') }}">
                                <span class="badge bg-info p-1">
                                    <i class="ri-shopping-cart-line fs-16"></i>
                                    <span id="cart-count" class="fs-14 ms-1"></span>
                                </span>
                            </a>
                        @endif
                    </div>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>



                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line fs-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>

                    <li class="dropdown">
                        @php
                            $locale = app()->getLocale();
                            $languages = [
                                'en' => ['name' => __('message.English'), 'flag' => 'us.jpg'],
                                'fr' => ['name' => __('message.Franch'), 'flag' => 'french.jpg'],
                            ];
                        @endphp
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/images/flags/' . $languages[$locale]['flag']) }}" alt="Flag"
                                class="me-0 me-sm-1" height="12">
                            <span
                                class="align-middle d-none d-lg-inline-block">{{ $languages[$locale]['name'] }}</span>
                            <i class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                            @foreach ($languages as $key => $lang)
                                @if ($key !== $locale)
                                    <a href="{{ route('lang.change', ['lang' => $key]) }}" class="dropdown-item">
                                        <img src="{{ asset('assets/images/flags/' . $lang['flag']) }}"
                                            alt="{{ $lang['name'] }}" class="me-1" height="12">
                                        <span class="align-middle">{{ $lang['name'] }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </li>











                    <li class="dropdown me-md-2">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                    width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ Auth::user()->user_name }}</h5>
                                <h6 class="my-0 fw-normal">{{ Auth::user()->role }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-account-circle-fill align-middle me-1"></i>
                                <span>My Account</span>
                            </a>






                            <!-- item-->
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                <i class="ri-logout-box-fill align-middle me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="{{ route('dashboard') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ route('dashboard') }}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!--- Sidemenu -->
                @if (Auth::user()->role == 'admin')
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a href="{{ route('tires.search') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-fill"></i>
                                <span> Recherche Rapide </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('user.index') }}" class="side-nav-link">
                                <i class="ri-user-line"></i>
                                <span> Add Users </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('tires.index') }}" class="side-nav-link">
                                <i class="ri-shopping-cart-fill"></i>
                                <span> Tires </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('tires.inventory') }}" class="side-nav-link">
                                <i class="fas fa-boxes"></i>
                                <span> Inventory </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="side-nav-link">
                                <i class="ri-file-list-3-fill"></i>
                                <span> Orders </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="apps-calendar.html" class="side-nav-link">
                                <i class="ri-calendar-2-fill"></i>
                                <span> Recherche Simplifie </span>
                            </a>
                        </li>


                        <li class="side-nav-item">
                            <a href="{{ route('support.index') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-fill"></i>
                                <span> Customer Support List </span>
                            </a>
                        </li>
                    </ul>
                @endif


                @if (Auth::user()->role == 'stock_manager')
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a href="{{ route('tires.search') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-fill"></i>
                                <span> Recherche Rapide </span>
                            </a>
                        </li>

                        

                        <li class="side-nav-item">
                            <a href="{{ route('tires.index') }}" class="side-nav-link">
                                <i class="ri-shopping-cart-fill"></i>
                                <span> Tires </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('tires.inventory') }}" class="side-nav-link">
                                <i class="fas fa-boxes"></i>
                                <span> Inventory </span>
                            </a>
                        </li>
                        
                       


                    
                    </ul>
                @endif



                @if (Auth::user()->role == 'user')
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a href="{{ route('tires.search') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-fill"></i>
                                <span> Recherche Rapide </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="side-nav-link">
                                <i class="ri-file-list-3-fill"></i>
                                <span> Orders </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('support.create') }}" class="side-nav-link">
                                <i class="ri-dashboard-2-fill"></i>
                                <span> Customer Support </span>
                            </a>
                        </li>

                    </ul>
                @endif
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->

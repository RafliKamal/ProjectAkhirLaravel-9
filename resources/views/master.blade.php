<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/flag-icon-css/css/flag-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('corona/assets/images/favicon.png') }}" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-scroller,
        .page-body-wrapper,
        .main-panel {
            min-height: 100vh;
        }

        .content-wrapper {
            padding-bottom: 50px;
            z-index: -99;
        }
        .sidebar{
            z-index: 99;
        }
        .sidebar-offcanvas {
            z-index: 99;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas active" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo ms-5" ><img
                        src="{{ asset('/LogoSIMU.png') }}" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini ms-1" ><img
                        src="{{ asset('/LogoSIMUmini.png') }}" alt="logo" /></a>
            </div>
            @auth
                
            
            <ul class="nav fixed-top">
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                @if(auth()->user()->role != 'Mahasiswa')
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/dashboard">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                @endif
                <li class="nav-item menu-items">
                  <a class="nav-link" href="/lihatUjian">
                      <span class="menu-icon">
                          <i class="mdi mdi-file-document"></i>
                      </span>
                      <span class="menu-title">Lihat Ujian</span>
                  </a>
              </li>
              @if(auth()->user()->role == 'Admin')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                        aria-controls="tables">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Tables</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="/tbUser">User</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/tbProdi">Prodi</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/tbMatkul">Mata Kuliah</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/tbSoal">Soal</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/tbUjian">Ujian</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if(auth()->user()->role != 'Mahasiswa')
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/BuatSoal">
                        <span class="menu-icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span class="menu-title">Membuat Soal</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/BankSoal">
                        <span class="menu-icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span class="menu-title">Bank Soal</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/BuatUjian">
                        <span class="menu-icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span class="menu-title">Membuat Ujian</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role == 'Kaprodi' || auth()->user()->role == 'Admin'  )
                    
                <li class="nav-item menu-items">
                    <a class="nav-link" href="/ReviewUjian">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">Review Ujian</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                @endif
            </ul>
            @endauth
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="/master"><img
                            src="{{ asset('corona/assets/images/logo-mini.svg') }}" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>

                    <ul class="navbar-nav navbar-nav-right">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle"
                                        src="{{ asset('corona/assets/images/faces/face15.jpg') }}" alt="">

                                    @auth
                                        <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                            {{ auth()->user()->name }}</p>
                                    @else
                                        <p class="mb-0 d-none d-sm-block navbar-profile-name">Not Authenticated</p>
                                    @endauth

                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                
                                <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel sticky-top">
                <div class="content-wrapper">
                    @yield('halaman_utama')
                </div>
                <!-- content-wrapper ends -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset('corona/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('corona/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('corona/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('corona/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('corona/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('corona/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('corona/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('corona/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('corona/assets/js/misc.js') }}"></script>
    <script src="{{ asset('corona/assets/js/settings.js') }}"></script>
    <script src="{{ asset('corona/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('corona/assets/js/proBanner.js') }}"></script>
    <script src="{{ asset('corona/assets/js/dashboard.js') }}"></script>
</body>

</html>

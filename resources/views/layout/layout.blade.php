<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>AutoBox</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/logo-color.svg') }}" />
    <!-- Template CSS -->
    <link href="{{ asset('assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"
        integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <style>
        div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
            display: none !important;
        }
    </style>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="" class="brand-wrap">
                <img src="{{ asset('assets/imgs/theme/logo-color.png') }}" class="logo" alt="Nest Dashboard" />
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"><i
                        class="text-muted material-icons md-menu_open"></i></button>
            </div>
        </div>
        <nav>
            <ul class="menu-aside">
            <a class="menu-link" href="">
                <i style="margin-right: 12px !important; color: #2AAA8A !important;"
                    class="fa-solid fa-user fa-lg"></i>
                <span class="text">Admin Management</span>
            </a>
            <a class="menu-link" href="{{ route('admin.orderManagement') }}">
                <i style="margin-right: 12px !important; color: #2AAA8A !important;"
                    class="fa-solid fa-user fa-lg"></i>
                <span class="text">Order Management</span>
            </a>
            <a class="menu-link" href="{{ route('admin.slideManagement') }}">
                <i style="margin-right: 12px !important; color: #2AAA8A !important;"
                    class="fa-solid fa-user fa-lg"></i>
                <span class="text">Slide Management</span>
            </a>
            <a class="menu-link" href="{{ route('admin.categoryManagement') }}">
                <i style="margin-right: 12px !important; color: #2AAA8A !important;"
                    class="fa-solid fa-user fa-lg"></i>
                <span class="text">Category Management</span>
            </a>
            <a class="menu-link" href="{{ route('admin.couponManagement') }}">
                <i style="margin-right: 12px !important; color: #2AAA8A !important;"
                    class="fa-solid fa-user fa-lg"></i>
                <span class="text">Coupon Management</span>
            </a>
            <a class="menu-link" href="{{ route('admin.reviewManagement') }}">
                <i style="margin-right: 12px !important; color: #2AAA8A !important;"
                    class="fa-solid fa-user fa-lg"></i>
                <span class="text">Review Management</span>
            </a>
        </li>
             
            </ul>
            <hr />
            <ul class="menu-aside">

            </ul>
            <br />
            <br />
        </nav>
    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">

            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i
                        class="material-icons md-apps"></i></button>
                <ul class="nav">

                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i
                                class="material-icons md-cast"></i></a>
                    </li>

                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount"
                            aria-expanded="false"> <img class="img-xs rounded-circle"
                                src="{{ asset('assets/imgs/people/avatar-2.png') }}" alt="User" /></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">

                            <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger"
                                href="#"><i class="material-icons md-exit_to_app"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        @yield('section')
        <!-- content-main end// -->
        <footer class="main-footer font-xs">
            <div class="row pb-30 pt-15">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; BuyNet.com
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">All rights reserved</div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Main Script -->
    <script src="{{ asset('assets/js/main.js?v=1.1') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom-chart.js') }}" type="text/javascript"></script>
</body>

</html>

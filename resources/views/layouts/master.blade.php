<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Penjualan - @yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/logo-nobg.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Chart list Js -->
    <link rel="stylesheet" href="{{ asset('js/chartist/chartist.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('js/sweetalert2/sweetalert2.min.css') }}">
</head>

<body class="sidebar-main-active right-column-fixed header-top-bgcolor">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('layouts.sidebar')
        <!-- TOP Nav Bar -->
        <div class="iq-top-navbar m-0" style="width: 90% !important;">
            <div class="iq-navbar-custom">
                <div class="iq-sidebar-logo">
                    <div class="top-logo">
                        <a href="index.html" class="logo">
                            <div class="iq-light-logo">
                                <img src="{{ asset('images/logo.gif') }}" class="img-fluid" alt="">
                            </div>
                            <div class="iq-dark-logo">
                                <img src="{{ asset('images/logo-dark.gif') }}" class="img-fluid" alt="">
                            </div>
                            <span>vito</span>
                        </a>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light justify-content-between p-0">
                    <div class="navbar-left">
                        <div class="iq-search-bar d-none d-md-block">
                            <form action="#" class="searchbox">
                                <input type="text" class="text search-input" placeholder="Type here to search...">
                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                <div class="searchbox-datalink">
                                    <h6 class="pl-3 pt-3 pb-3">Pages</h6>
                                    <ul class="m-0 pl-3 pr-3 pb-3">
                                        <li class="iq-bg-primary-hover rounded"><a href="index.html"
                                                class="nav-link router-link-exact-active router-link-active pr-2"><i
                                                    class="ri-home-4-line pr-2"></i>Dashboard</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="dashboard-1.html"
                                                class="nav-link router-link-exact-active router-link-active pr-2"><i
                                                    class="ri-home-3-line pr-2"></i>Dashboard-1</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="chat.html" class="nav-link"><i
                                                    class="ri-message-line pr-2"></i>Chat</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="calendar.html"
                                                class="nav-link"><i class="ri-calendar-2-line pr-2"></i>Calendar</a>
                                        </li>
                                        <li class="iq-bg-primary-hover rounded"><a href="profile.html"
                                                class="nav-link"><i class="ri-profile-line pr-2"></i>Profile</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="todo.html" class="nav-link"><i
                                                    class="ri-chat-check-line pr-2"></i>Todo</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="app/index.html"
                                                class="nav-link"><i class="ri-mail-line pr-2"></i>Email</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="pages-faq.html"
                                                class="nav-link"><i class="ri-compasses-line pr-2"></i>Faq</a></li>
                                        <li class="iq-bg-primary-hover rounded"><a href="form-wizard.html"
                                                class="nav-link"><i class="ri-clockwise-line pr-2"></i>Form-wizard</a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                            <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                            <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                        </div>
                    </div>
                    <ul class="navbar-list">
                        <li>
                            <a href="#"
                                class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                                {{-- <img src="{{ asset('images/user/1.jpg') }}" class="img-fluid rounded mr-3"
                                    alt="user"> --}}
                                <div class="caption">
                                    <h6 class="mb-0 line-height text-white">
                                        {{ Auth::user() ? Auth::User()->username : '' }}</h6>
                                    {{-- <span class="font-size-12 text-white">Available</span> --}}
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        {{-- <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">Hello
                                                {{ Auth::user() ? Auth::User()->username : '' }}</h5>
                                            <span class="text-white font-size-12">Available</span>
                                        </div> --}}
                                        {{-- <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">My Profile</h6>
                                                    <p class="mb-0 font-size-12">View personal profile details.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-profile-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Edit Profile</h6>
                                                    <p class="mb-0 font-size-12">Modify your personal details.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Account settings</h6>
                                                    <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-lock-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Privacy Settings</h6>
                                                    <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                                </div>
                                            </div>
                                        </a> --}}
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="btn btn-primary dark-btn-primary" href="{{ route('logout') }}"
                                                role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- TOP Nav Bar END -->
        <!-- Page Content  -->
        <div id="content-page" class="content-page" style="width: 94%;">
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>


    </div>

    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="iq-footer m-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">Vito</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>


    <!-- Footer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $('.currency').on('input', function() {
            var value = $(this).val();

            value = value.replace(/[^0-9]/g, '');

            var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $(this).val(formattedValue);
        });

        $('.number').on('input', function() {
            var value = $(this).val();

            value = value.replace(/\D/g, '');

            $(this).val(value);
        });
    </script>
    @yield('scripts')

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('js/lottie.js') }}"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('js/core.js') }}"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('js/charts.js') }}"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('js/animated.js') }}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('js/kelly.js') }}"></script>
    <!-- Morris JavaScript -->
    <script src="{{ asset('js/morris.js') }}"></script>
    <!-- am maps JavaScript -->
    <script src="{{ asset('js/maps.js') }}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{ asset('js/worldLow.js') }}"></script>
    <!-- ChartList Js -->
    <script src="{{ asset('js/chartist/chartist.min.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
    @include('layouts.sweetalerts')
    <script>
        $('#basic-datatables').DataTable({});
    </script>
</body>

</html>

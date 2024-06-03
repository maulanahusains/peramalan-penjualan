<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Peramalan Penjualan</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    {{-- Sweetalert CSS --}}
    <link rel="stylesheet" href="{{ asset('js/sweetalert2/sweetalert2.min.css') }}">
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Sign in Start -->
    <section class="sign-in-page">
        <div class="container bg-white p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center" id="forgot-pass-col">
                    <div class="sign-in-from">
                        <h1 class="mb-0 dark-signin">Lupa Password</h1>
                        <p>Silahkan masukkan password baru anda untuk mereset password.</p>
                        <form class="mt-4" action="{{ route('reset-password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->encrypted_id }}">
                            <input type="hidden" name="username" value="{{ $user->username }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password Baru</label>
                                <input type="password" class="form-control mb-0" name="new_password"
                                    placeholder="Password Baru">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                <input type="password" class="form-control mb-0" name="confirm_password"
                                    placeholder="Konfirmasi Password">
                                @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-inline-block w-100">
                                <div class="d-inline-block mt-2 pt-1">
                                    <label class="">Apakah anda ingin masuk? <a href=""
                                            class="btn-login">Masuk</a></label>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="sign-in-detail text-white">
                        {{-- <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid" alt="logo"></a> --}}
                        <a class="sign-in-logo mb-5 text-white h1" href="#">Judul</a>
                        <div class="slick-slider11" data-autoplay="true" data-loop="true" data-nav="false"
                            data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1"
                            data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                            <div class="item">
                                <img src="{{ asset('images/login/1.png') }}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Gambar satu</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo magni laudantium at
                                    quibusdam! Possimus, corporis sunt libero dolores quos consequuntur ea at hic minima
                                    laboriosam placeat eum blanditiis nisi inventore?</p>
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/login/1.png') }}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Gambar dua</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo magni laudantium at
                                    quibusdam! Possimus, corporis sunt libero dolores quos consequuntur ea at hic minima
                                    laboriosam placeat eum blanditiis nisi inventore?</p>
                            </div>
                            <div class="item">
                                <img src="{{ asset('images/login/1.png') }}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">Gambar tiga</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo magni laudantium at
                                    quibusdam! Possimus, corporis sunt libero dolores quos consequuntur ea at hic minima
                                    laboriosam placeat eum blanditiis nisi inventore?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign in END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @include('layouts.sweetalerts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
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
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>

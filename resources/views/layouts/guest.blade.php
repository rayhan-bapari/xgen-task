<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        @yield('title') | {{ config('app.name') }}
    </title>

    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/favicons.png') }}" type="icon/png" />
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- All Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/icon.css') }}">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <!-- Select2 Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <!-- Sweet alert Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}">
    <!-- Flatpickr Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}">
    <!-- Country Select Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/niceCountryInput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jsuites.css') }}">
    <!-- Fancy box Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <!-- dark css -->
</head>

<body>
    <!--login Area start-->
    <section class="loginForm">
        <div class="loginForm__flex">
            <div class="loginForm__left">
                <div class="loginForm__left__inner desktop-center">
                    <div class="loginForm__header">
                        <h2 class="loginForm__header__title">
                            {{ $title ?? '' }}
                        </h2>
                        <p class="loginForm__header__para mt-3">
                            {{ $description ?? '' }}
                        </p>
                    </div>
                    <div class="loginForm__wrapper mt-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <div class="loginForm__right loginForm__bg "
                style="background-image: url('{{ asset('assets/img/login.jpg') }}');">
                <div class="loginForm__right__logo">
                    <div class="loginForm__logo">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('assets/img/logo.webp') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Area end -->

    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <!-- jquery Migrate -->
    <script src="{{ asset('assets/js/jquery-migrate-3.4.1.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <!-- Plugins Js -->
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <!-- Country Select Js -->
    <script src="{{ asset('assets/js/niceCountryInput.js') }}"></script>
    <!-- Multiple Country Select Js -->
    <script src="{{ asset('assets/js/jsuites.js') }}"></script>
    <!-- Fancy box Js -->
    <script src="{{ asset('assets/js/fancybox.umd.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('custom_js')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ECM APP</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/logo-ECM01.png') }}" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <!-- font_awesome Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    @if (request()->routeIs('teacher.edit'))
        @vite(['resources/js/certificate.js', 'resources/js/experience.js'])
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/Table/style.scss', 'resources/css/Teacher/timekeeping.scss', 'resources/css/Teacher/userSearchBar.scss', 'resources/css/Teacher/table_timekeeping.scss', 'resources/css/Teacher/course.scss'])

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Navbar -->
            @include('partials.navbar')
            <!-- End Navbar -->
            <div class="container">
                <div class="page-inner">
                    <main>
                        @yield('breadcrumbs')

                    </main>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="card"> --}}
                    <main>
                        @yield('content')
                    </main>
                    {{-- </div>
                        </div>
                    </div> --}}
                </div>
            </div>


            @include('partials.footer')
        </div>

    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>


    @yield('after_js')
</body>

</html>

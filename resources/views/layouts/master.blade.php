<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Federation Of Kenya :: Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Federation Of Kenya Members Portal" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png')}}">
    @include('layouts.head')
</head>

@section('body')
@show

<body data-layout="detached" data-topbar="colored">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div class="container-fluid px-0">
        <div id="layout-wrapper">
            @include('layouts.topbar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class=" page-content">
                    <div class="text-center" style="margin-top:20px !important;">
                        @include('layouts.notification')
                    </div>
                    @yield('content')
                </div>
                <!-- End Page-content -->

            </div>
            <!-- end main content-->
        </div>

        <!-- END layout-wrapper -->
    </div>
    @include('layouts.footer')
    <!-- END container-fluid -->

    <!-- JAVASCRIPT -->
    @include('layouts.footer-script')
    <script>
    window.addEventListener('scroll', (e) => {
        const nav = document.querySelector('.navbar');
        if (window.pageYOffset > 0) {
            nav.classList.add("add-shadow");
        } else {
            nav.classList.remove("add-shadow");
        }
    });
    window.onload = function() {
        if (typeof fnOnLoad === "function") {
            fnOnLoad();
        }
    }
    </script>

</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Federation Of Kenya Employers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Federation Of Kenya Employers Admin" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png')}}">
    @include('layouts.head')
</head>
<div class="text-center" style="margin-top:20px !important">
    @include('layouts.notification')
</div>
@yield('body')

@yield('content')

@include('layouts.footer-script')
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js">
    </script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>Federation of Kenya Employers</title>
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png')}}">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend+Deca&family=Work+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed&family=Noto+Sans+Javanese&display=swap');

    :root {
        --first-color: #301968;
        --first-color-light: #ba0e2c;
        --font1: 'Fira Sans Condensed', sans-serif;
        --font2: 'Noto Sans Javanese', sans-serif;
        --title-font: 'Lexend Deca', sans-serif;
        --para-font: 'Work Sans', sans-serif;
    }

    .br {
        color: var(--first-color) !important;
        text-decoration: none !important;
    }

    .brs {
        color: var(--first-color-light) !important;
    }

    .brand {
        margin-top: 10px;
    }

    .brand h2 {
        color: rgb(238, 236, 236);
        font-size: 2rem;
        font-weight: 300;
        font-style: normal;
        line-height: 50px;
        text-shadow: 0 1px 0 var(--first-color-light);
        font-family: var(--title-font);
    }

    .br-brand {
        font-weight: bold;
        color: #CACFD2;
        text-shadow: 0 1px 0 var(--first-color-light);
    }

    .testimonial {
        margin-top: 1rem;
        text-align: center;
    }

    .testimonial .pic {
        width: 220px;
        height: 220px;
        margin: 0 auto;
        margin-bottom: 25px;
    }

    .testimonial .pic img {
        width: 100%;
        height: 100%;
    }

    .testimonial .description {
        font-size: 14px;
        color: white;
        line-height: 27px;
        position: relative;
        margin: 0;
        font-family: var(--para-font);
    }


    .heading-title {
        margin-bottom: 100px;
    }


    .owl-theme .owl-controls .owl-page span {
        background: #fff;
        border: 2px solid var(--first-color);
        opacity: 1;
    }

    .owl-theme .owl-controls .owl-page.active span,
    .owl-theme .owl-controls .owl-page:hover span {
        border: 2px solid #fa7921;
    }

    .n-login {
        height: 100vh;
        width: 100%;
        overflow-x: hidden;
    }

    .n-left {
        background-color: var(--first-color);
        min-height: 100vh;
    }

    .n-icon {
        margin-top: 75px;
    }

    .logo {
        margin-top: 40px;
    }

    .logo img {
        width: 300px;
        height: auto;
    }

    .form-text {
        margin-top: 70px;
        margin-left: 85px;
    }

    .form-text h3 {
        font-family: var(--title-font);
        font-weight: 700;
        font-style: normal;
        font-size: 26px;
        color: var(--first-color-light);
        line-height: 40px;
        text-transform: uppercase;
    }

    .form-text p {
        font-family: var(--para-font);
        font-weight: 400;
        font-style: normal;
        font-size: 16px;
        color: var(--first-color);
        line-height: 24px;
    }

    .l-form {
        margin-top: 20px;
        margin-left: 85px;
        padding-right: 50px;
    }

    label {
        font-family: var(--para-font);
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 18px;
        color: #60606A;
    }

    .form-control,
    .form-control:focus,
    .input-group-addon {
        border-color: var(--first-color);
        border-radius: 4px;
    }

    .login-form .form-group {
        margin-bottom: 40px;
    }

    .login-form label {
        font-weight: normal;
        font-size: 15px;
    }

    .login-form .form-control {
        min-height: 38px;
        box-shadow: none !important;
        border-width: 0 0 1px 0;
        background-color: whitesmoke;
    }

    .login-form .btn,
    .login-form .btn:active {
        font-size: 16px;
        font-weight: bold;
        background: var(--first-color) !important;
        border-radius: 3px;
        border: none;
        min-width: 100%;
    }

    .login-form .btn:hover,
    .login-form .btn:focus {
        background: var(--first-color-light) !important;
    }

    .login-form a {
        color: var(--first-color-light);
        text-decoration: none;
    }

    .login-form a:hover {
        text-decoration: underline;
    }

    .login-form .small {
        display: inline-block;
    }

    .login-form .small:hover {
        display: inline-block;
        color: var(--first-color-light);
        text-decoration: none;
    }

    .last {
        margin-top: 4rem;
        color: #EAF2F8;
        font-size: 12px;
        font-family: var(--para-font);
    }

    .modal-header {}


    .modal-body {
        background-image: linear-gradient(to right top, #f2f2f2, #f0f0f0, #ededed, #ebebeb, #e9e9e9);

    }

    .modal-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: none !important;
        color: #fff !important;
        background-image: linear-gradient(to left bottom, #ba0e2c, #e91135, #7a0b1e, #ba0e2c, #b31c35);

    }

    .modal-header h5 {
        font-family: var(--title-font);
        font-size: 1rem;
        color: #fff !important;
    }

    .button-2 {
        padding: 13px 50px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        border-radius: .25rem;
        display: block;
        border: 0px;
        font-weight: 700;
        box-shadow: 0px 0px 14px -7px var(--first-color);
        background-image: linear-gradient(45deg, #15a752 0%, #34cc73 51%, #81ebad 100%);
        cursor: pointer;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-2:hover {
        background-position: right center;
        color: #fff !important;
        text-decoration: none;
    }

    .button-87:active {
        transform: scale(0.95);
    }

    .button-87 {
        padding: 13px 50px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        border-radius: .25rem;
        display: block;
        border: 0px;
        font-weight: 700;
        box-shadow: 0px 0px 14px -7px #f09819;
        background-image: linear-gradient(45deg, #ba0e2c 0%, #ec435f 51%, #ba0e2c 100%);
        cursor: pointer;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-87:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }

    .button-87:active {
        transform: scale(0.95);
    }
    </style>
</head>

<body>
    <section class="n-login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 n-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="n-icon mx-auto text-center">
                                <p>
                                    <i class="fas fa-align-left" style="color:white;font-size:25px"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mx-auto text-center">
                            <div class="brand">
                                <h2 class="n-brand my-4">MEMBER'S PORTAL</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="testimonial-slider" class="owl-carousel">
                                <div class="testimonial">
                                    <div class="pic">
                                        <img src="{{ URL::asset('images/h1.png')}}" alt="" />
                                    </div>

                                    <p class="description">
                                        Employees spend nearly two thirds of their waking hours at workplaces. It is
                                        therefore critical that every employer considers and prioritizes matters related
                                        to safe and healthy work environments.
                                        <span>
                                            <a href="https://fke-kenya.org/index.php/media-center/events/practical-guide-implementation-osh-principles-and-policies-workplace"
                                                target="blank" class="br">Read More...</a>
                                        </span>
                                    </p>
                                </div>

                                <div class="testimonial">
                                    <div class="pic">
                                        <img src="{{ URL::asset('images/error-img.png')}}" alt="" />
                                    </div>
                                    <p class="description">
                                        Employees spend nearly two thirds of their waking hours at workplaces. It is
                                        therefore critical that every employer considers and prioritizes matters related
                                        to safe and healthy work environments.
                                        <span><a href="https://fke-kenya.org/index.php/media-center/events/practical-guide-implementation-osh-principles-and-policies-workplace"
                                                target="blank" class="br">Read More...</a></span>
                                    </p>
                                </div>

                                <div class="testimonial">
                                    <div class="pic">
                                        <img src="{{ URL::asset('images/maintenance.png')}}" alt="" />
                                    </div>
                                    <p class="description">
                                        Employees spend nearly two thirds of their waking hours at workplaces. It is
                                        therefore critical that every employer considers and prioritizes matters related
                                        to safe and healthy work environments.
                                        <span><a href="https://fke-kenya.org/index.php/media-center/events/practical-guide-implementation-osh-principles-and-policies-workplace"
                                                target="blank" class="br">Read More...</a></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center last">
                                <p>© <script>
                                    document.write(new Date().getFullYear())
                                    </script> Federation Of Kenya Employers
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logo mx-auto text-center">
                                <img src="{{ URL::asset('images/fkelogo.png')}}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-text">
                                <div class="pr-3" style="margin-right: 2rem !important;">
                                    @include('layouts.notification')
                                </div>
                                <h3>Sign In</h3>
                                <p class="text-dark">
                                    Don't have an account? <a href="/register" style="text-decoration: none;">Signup
                                        Now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="l-form">
                                <div class="login-form">
                                    <form action="{{action('GeneralController@login')}}" method="POST"
                                        autocomplete="off" id="submitlogin" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="username">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}" name="password" required
                                                autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100"
                                                style="text-decoration:none;color:white;text-shadow: 0 1px 0 #008080;">Login</button>

                                        </div>
                                        <p class="small"> <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#forgotPassword">Forgot Password?</a>
                                        </p>
                                        <p class="small"> <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#resetPassword">Reset Password?</a>
                                        </p>
                                        <p class="small"> <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#claimPayment">Claim Payment</a>
                                        </p>

                                    </form>
                                    <p class="small"> <a
                                            href="https://www.fke-kenya.org/sites/default/files/2024-01/FKE%20Training%20calender%202024.pdf"
                                            class="text-muted" target="blank"><i class="mdi mdi-bank mr-1"></i>
                                            2024 FKE Training Calendar </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Modals -->
    <!-- Forgot Passord -->
    <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{action('GeneralController@forgotPassword')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Member No</label>
                            <input type="text" name='memberno' class="form-control" placeholder="00-001">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary button-87 w-100">Send Reset Email <i
                                    class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resetPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{action('GeneralController@resetPassword')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Member No</label>
                            <input type="text" name='memberno' class="form-control" placeholder="00-001">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Reset Token</label>
                            <input type="text" name='resetToken' class="form-control" placeholder="123321">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">New Password</label>
                            <input type="password" name='newPassword' class="form-control" placeholder="*******">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary button-87 w-100">Reset Password<i
                                    class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Claim Payment -->
    <div class="modal fade" id="claimPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Claim Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{action('FinancialsController@claimPaymentB4Login')}}" method="POST"
                        autocomplete="off" id="submitlogin" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="refno" class="form-label">Transaction Reference Number</label>
                            <input id="refno" type="text" class="form-control @error('refno') is-invalid @enderror"
                                name="refno" value="{{ old('refno') }}" required autocomplete="refno" autofocus>
                            @error('refno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label for="compreg" class="form-label">Company Registration Number</label>
                            <input id="compreg" type="text" class="form-control @error('compreg') is-invalid @enderror"
                                name="compreg" value="{{ old('compreg') }}" required autocomplete="compreg" autofocus>
                            @error('compreg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary button-87 w-100">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
    $(document).ready(function() {
        $("#testimonial-slider").owlCarousel({
            items: 1,
            itemsDesktop: [1000, 1],
            itemsDesktopSmall: [979, 1],
            itemsTablet: [768, 1],
            pagination: true,
            navigation: false,
            navigationText: ["", ""],
            slideSpeed: 1000,
            singleItem: true,
            transitionStyle: "fade",
            autoPlay: true
        });
    });
    </script>
</body>

</html>
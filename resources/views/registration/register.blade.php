<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

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

    .stepper .line {
        width: 2px;
        background-color: whitesmoke !important;
    }

    .stepper .lead {
        font-size: 1.1rem;
    }

    .rounded-circle i {
        color: var(--first-color-light);
    }

    .RoundedText {
        font-family: var(--font1);
        margin-left: .7rem;
        color: white;
    }

    .heading-title {
        margin-bottom: 100px;
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
                <div class="col-md-5 n-left">
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
                                <h2 class="n-brand my-4">MEMEBERSHIP SIGN UP</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="stepper d-flex flex-column mt-5 ml-2">
                                <div class="d-flex mb-1">
                                    <div class="d-flex flex-column pr-4 align-items-center">
                                        <div class="rounded-circle py-2 px-3 bg-white text-white mb-1"><i
                                                class="fa fa-check" aria-hidden="true"></i></div>
                                        <div class="line h-100"></div>
                                    </div>
                                    <div>
                                        <h5 class="RoundedText">Step 1</h5>
                                        <p class="lead text-muted pb-3">Choose your website name & create repository</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <div class="d-flex flex-column pr-4 align-items-center">
                                        <div class="rounded-circle py-2 px-3 bg-white text-white mb-1"><i
                                                class="fa fa-circle" aria-hidden="true"></i></div>

                                    </div>
                                    <div>
                                        <h5 class="RoundedText">Step 2</h5>
                                        <p class="lead text-muted pb-3">Go to your dashboard and clone Git respository
                                            from the url in the
                                            dashboard of your application</p>
                                    </div>
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
                <div class="col-md-7">
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
                                <h3>Sign Up</h3>
                                <p class="text-dark">
                                    Already have an account? <a href="/" style="text-decoration: none;">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="l-form">
                                <div class="login-form">
                                    <form method="POST" action="{{ action('GeneralController@createaccount') }}"
                                        id="submitregistration" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="businessname"
                                                        value="{{ old('businessname') }}" id="businessname"
                                                        placeholder="{{ __('Business Name') }}"
                                                        autocomplete="businessname" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="compreg" class="form-control" required
                                                        value="{{ old('compreg') }}" id="compreg"
                                                        placeholder="Enter {{ __('Company Registration Number') }}"
                                                        autocomplete="compreg" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="postal_address"
                                                        value="{{ old('postal_address') }}" id="postal_address"
                                                        placeholder="Enter {{ __('Company Postal Address') }}"
                                                        autocomplete="postal_address" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="physical_address"
                                                        value="{{ old('physical_address') }}" id="physical_address"
                                                        placeholder="Enter {{ __('Company Physical Address') }}"
                                                        autocomplete="physical_address" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" required name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" id="useremail"
                                                        placeholder="Enter {{ __('Company E-Mail Address') }}"
                                                        autocomplete="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="phone" value="{{ old('phone') }}" required
                                                        autocomplete="phone"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        autofocus id="phone"
                                                        placeholder="Enter {{ __('Phone Number') }}" required autofocus>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select id="memberType" name="memberType" class="form-control"
                                                        required>
                                                        <option value="">{{ __('Member Type') }}</option>
                                                        @foreach ($MemberTypes as $type)
                                                        <option value="{{$type['Code']}}">{{$type['Code']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="contactperson"
                                                        value="{{ old('contactperson') }}" id="contactperson"
                                                        placeholder="Enter {{ __('Contact Person') }}"
                                                        autocomplete="contactperson" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label
                                                        for="userpassword">{{ __('Select Nearest Branch of Service') }}</label>
                                                    <select id="branch" name="branch" class="form-control" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100"
                                                style="text-decoration:none;color:white;text-shadow: 0 1px 0 #008080;">{{ __('Next Step') }}
                                                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>

                                        </div>
                                        <p class="small"> By registering you agree to our <a href="#"
                                                class="text-primary">Terms
                                                of
                                                Use</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Modals -->
    <!-- Reset Passord -->
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
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" name='email' class="form-control" placeholder="name@example.com">
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
    window.onload = function set_variables() {
        //get list of branches
        $.ajax({
            type: "GET",
            url: "/branches",
            success: function(result) {
                $("#branch").html(result);
                var branch = "<?php echo session('branch');?>";
                var old_branch = "<?php echo old('branch');?>";
                branch_cookie != null && branch_cookie != '' ? $("#branch").val(branch_cookie) : $(
                    "#branch").val(old_branch);
                $("#branch").prop('disabled', false);
            }
        });
    }
    </script>
</body>

</html>
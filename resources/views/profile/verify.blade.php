<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

    <title>Reset Password</title>
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

    .introduce h2 {
        font-family: var(--title-font) !important;
    }

    .introduce p {
        font-family: var(--para-font) !important;
    }
    </style>
</head>

<body>

    <section class="activate bg-white min-vh-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="introduce my-5">
                        <h2 class="text-center">Reset Your Password</h2>
                        <p class="text-center">Enter password to create a new password </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.notification')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="activateForm">
                        <form action="{% url 'reset_request' %}" method="POST">

                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password2" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 button-87">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
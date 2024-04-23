@extends('layouts.master')

@section('title') Downloads @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>Contact For Any Query</h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Contact
                </span></li>
        </ol>
    </div>
</div>
<div class="row contact gy-4">
    <div class="col-xl-6">

        <div class="row">
            <div class="col-lg-6">
                <div class="info-box card">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Address</h3>
                    <p>Nairobi Street,<br>Nairobi, Kenya</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-box card">
                    <i class="bi bi-telephone"></i>
                    <h3>Call Us</h3>
                    <p>+254 709 827101<br>+254 709 827101</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-box card">
                    <i class="bi bi-envelope"></i>
                    <h3>Email Us</h3>
                    <p>fkehq@fke-kenya.org<br>contact@example.com</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-box card">
                    <i class="bi bi-clock"></i>
                    <h3>Open Hours</h3>
                    <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                </div>
            </div>
        </div>

    </div>

    <div class="col-xl-6">
        <div class="card p-4">
            <form action="{{ action('UsersController@mailNotify') }}" method="post" class="php-email-form">
                @csrf
                <div class="row gy-4">

                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>

                    <div class="col-md-6 ">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                    </div>

                    <div class="col-md-12 my-3">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    </div>

                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="6" placeholder="Message"
                            required></textarea>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>

                        <button type="submit">Send Message</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

</div>
<!-- end row -->

@endsection
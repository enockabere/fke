@extends('layouts.master')

@section('title') User Management @endsection

@section('content')
<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3> User Management </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end breadcrumb-box">
            <li class="breadcrumb-item">
                <a href="/alldownloads/" class="breadcrumbs text-danger">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item dropdown" id="breadcrumbDropdown">
                <a href="#" class="breadcrumbs text-muted dropdown-toggle" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-plus"></i>Add New User
                </a>
            </li>
        </ol>
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="" action="{{ action('UsersController@createUser') }}">
                    <h4 class="card-title">Add New User</h4>

                    <input class="form-control" type="hidden" name="usertype" id="usertype" value="{{$userType}}">

                    <div class="form-group row">
                        <label for="fullname" class="col-md-2 col-form-label">Full Name <span
                                style="color:red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="fullname" id="fullname" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phonenumber" class="col-md-2 col-form-label">Phone Number <span
                                style="color:red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="phonenumber" id="phonenumber" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">Email <span
                                style="color:red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="designation" class="col-md-2 col-form-label">{{ __('Designation') }}</label>
                        <div class="col-md-10">
                            <select id="designation" name="designation" class="form-control">
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="accounttype" class="col-md-2 col-form-label">Account Type <span
                                style="color:red">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control" name="accounttype" required>
                                <option value="">Select Account Type</option>
                                <option value="Main Account">Main Account</option>
                                <option value="Associate Account">Associate Account</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="company" class="col-md-2 col-form-label">{{ __('Associated Company') }}</label>
                        <div class="col-md-10">
                            <select id="company" name="company" class="form-control">
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="role" class="col-md-2 col-form-label">Role <span style="color:red">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control" name="role" required>
                                <option value="">Select Role</option>
                                <option value="Super Administrator">Super Administrator</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Contributor">Contributor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label">Password: <span
                                style="color:red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="password" id="password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="passwordconfirmation" class="col-md-2 col-form-label">Confirm Password <span
                                style="color:red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="passwordconfirmation"
                                id="passwordconfirmation" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Add User</button>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
</form>


@endsection

@section('script')

<script>
$associate = $('.associate').val();

$(document).ready(function() {
    //get list of company
    $.ajax({
        type: "GET",
        url: "/companies",
        success: function(result) {
            $("#company").html(result);
            var company = "<?php echo session('company');?>";
            var old_company = "<?php echo old('company');?>";
        }
    });

    //get list of designation
    $.ajax({
        type: "GET",
        url: "/designations",
        success: function(result) {
            $("#designation").html(result);
            var company = "<?php echo session('designation');?>";
            var old_company = "<?php echo old('designation');?>";
        }
    });
});
</script>

@endsection
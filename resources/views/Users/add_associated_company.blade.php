@extends('layouts.master')

@section('title') User Management @endsection

@section('content')

@component('layouts.breadcrumb')
@slot('title') User Management @endslot
@slot('li_1') Add New Associated Company @endslot
@endcomponent
<form method="POST" action="{{ action('UsersController@createCompany') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Associated Company</h4>

                    <input class="form-control" type="hidden" name="usertype" id="usertype" value="{{$userType}}">

                    <div class="form-group row">
                        <label for="companyname" class="col-md-2 col-form-label">Company Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="companyname" id="companyname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="companyemail" class="col-md-2 col-form-label">Company Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" name="companyemail" id="companyemail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phonenumber" class="col-md-2 col-form-label">Company Phone No</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="phonenumber" id="phonenumber">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="website" class="col-md-2 col-form-label">website</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="website" id="website">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="address" id="address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postcode" class="col-md-2 col-form-label">Post Code</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="postcode" id="postcode">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-md-2 col-form-label">City</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="city" id="city">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="business_permit" class="col-md-2 col-form-label">Business Permit</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" name="business_permit" id="business_permit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employees" class="col-md-2 col-form-label">Number Of Employees</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="employees" id="employees">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nssf" class="col-md-2 col-form-label">NSSF Document</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" name="nssf" id="nssf">
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Add Associated Company</button>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</form>
@endsection

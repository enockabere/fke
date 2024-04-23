@extends('layouts.master')

@section('title') Events @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid px-0" id="holder">
    <div class="row">
        <div class="col-md-12">
            <div class="content-title mt-3">
                <h3> Event Details </h3>
            </div>
            <ol class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                            class="fa fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                        Event Details
                    </span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card event-card px-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="event-poster">
                            <img src="{{ URL::asset('images//eventbanners/banner05.jpg') }}" class="img-fluid"
                                data-holder-rendered="true">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="button-items" style="padding-left:10px;">
                            <button type="button" class="btn eventbutton">
                                <i class="fas fa-video font-size-16 align-middle mr-2"></i> Event Type:
                                {{$data['Event_Type']}}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-1" style="padding:20px 5px 0px 10px;">Event: {{$data['Event_Name']}}</h4>
                        <p style="padding:10px 5px 20px 10px;">Event Description: {{$data['Event_Description']}} </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="pl-2 ml-1">Registration Start Date:
                            <span style="color: #011A77">{{$data['Registration_Start_Date']}}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="pl-2 ml-1">Registration End Date:
                            <span style="color: #011A77"> {{$data['Registration_End_Date']}}</span>
                        </p>
                    </div>
                </div>
                <div class="row">

                    @if ($data['Chargeable'] == 1)
                    <div class="col-md-6">
                        <div class="bgs h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                            Kshs. {{$data['Total_Amount']}}

                            @if ($data['Inclusive_of_VAT'] == 1)
                            <p><b>Inc. of VAT: <span class="text-primary">Yes</span> </b></p>
                            @else
                            <p><b>Inc. of VAT: <span class="text-primary">No</span> </b></p>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="col-md-6">
                        <div class="bgs h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                            Ksh. Free
                        </div>
                    </div>
                    @endif

                    <div class="col-md-6">
                        <div class="bgs h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                            <i class="fas fa-calendar-alt"></i>
                            {{date_format(date_create($data['Event_Start_Date']),"d F Y")}}
                            @if ($data['Event_End_Date'])
                            to {{date_format(date_create($data['Event_End_Date']),"d F Y")}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row my-3 gx-2">
                    <div class="col-md-7">
                        <div class="bgs text-dark h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                            <i class="fas dripicons-location"></i> Venue: {{$data['Venue']}}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="bgs h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                            <i class="fas fa-clock"></i>
                            Time : {{$data['Event_Start_Time']}} to {{$data['Event_End_Time']}}
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- start -->
        <div class="col-md-4">
            <div class="card p-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="attendeeslist" class="form-label">Upload Attendee
                                    List</label>

                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ action('EventsController@addevent') }}" enctype="multipart/form-data"
                        id="frmAddEvent">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Enter Attendees Manually
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input class="form-control" type="hidden" name="event" id="event"
                                            value="{{$data['Event_No']}}">
                                        <div class="mb-2">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="Att_Name">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="Att_Email">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="Att_phone">
                                        </div>
                                        <div class="mb-2">
                                            <label for="paymentmethod" class="form-label">Payment Method</label>
                                            <select class="form-select" name="accounttype">
                                                <option value="Cheque">Cheque</option>
                                                <option value="Visa/Mastercard">Visa/Mastercard</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Payment</label>
                                            <select class="form-select" name="Payment">
                                                <option value="0">Pay Now</option>
                                                <option value="1">Pay Later</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary"
                                            form="frmAddEvent">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ action('EventsController@registerevent') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="hidden" name="event" id="event" value="{{$data['Event_No']}}">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Upload in csv file format.

                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <a href="{{url('/TemplateDownloads')}}" download="attendees"> Click
                                                to
                                                Download csv
                                                Template </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" type="file" name="attendeeslist" id="attendeeslist">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="paymentmethod" class="form-label">Payment Method</label>
                                            <select class="form-select" name="accounttype">
                                                <option value="Cheque">Cheque</option>
                                                <option value="Visa/Mastercard">Visa/Mastercard</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Payment</label>
                                                <select class="form-select" name="Payment">
                                                    <option value="0">Pay Now</option>
                                                    <option value="1">Pay Later</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div class="card p-2" style="background: whitesmoke">
                <div class="card-title  mx-auto text-center">
                    <h5>Event Media</h5>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">

                            <ul class="inbox-wid list-unstyled">

                                <li class="inbox-list-item">
                                    <a href="">
                                        <div class="media">

                                            <div class="media-body overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Download</h5>

                                            </div>
                                            <div class="font-size-12 ml-2">
                                                <i class="fas fa-download"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>

                            <div class="text-center">
                                <a href="#" class="btn btn-primary btn-sm">Load more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
@endsection
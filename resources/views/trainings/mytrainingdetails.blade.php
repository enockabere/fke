@extends('layouts.master')

@section('title') My Training Details @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/libs/bootstrap-rating/bootstrap-rating.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="content-title mt-3">
            <h3> My Training Details </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    My Training Details
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">
                <div class="trainingheader">
                    <img src="{{ URL::asset('images/theader.png') }}">

                    <h4>{{$MyTrainings['Programme_Code']}} - {{$MyTrainings['Programme_Description']}}</h4>
                    <div class="row traininginfo">
                        <div class="col-lg-3"><i class="fas fa-calendar-alt"></i>
                            {{date_format(date_create($MyTrainings['Training_Date']), "l,  d F Y")}}</div>
                        <div class="col-lg-3"><i class="fas fa-users"></i> {{$MyTrainings['No_of_Attendees']}}
                            registered members</div>
                        <div class="col-lg-3"><i class="fas fa-map-marker-alt"></i> {{$MyTrainings['Training_Method'] }}
                        </div>
                        <div class="col-lg-3"><i class="fas fa-coins"></i> Total Payable:
                            <strong> KES {{$MyTrainings['Total_Payable'] }}</strong>
                        </div>
                    </div>
                    <h5>Overview</h5>
                    <p>{{$MyTrainings['Description']}}</p>

                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title">Attendee's List</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($Attendees as $attendee)
                                <tr>
                                    <td>{{$attendee['Name']}}</td>
                                    <td>{{$attendee['Email_Address']}}</td>
                                    <td>{{$attendee['Phone_No']}}</td>
                                    @if ($attendee['Attended'] == true)
                                    <td>Present</td>
                                    @else
                                    <td>Absent</td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <style>
                label {
                    font-weight: bold;
                    margin-bottom: 0.5rem;
                    display: block;
                }

                input[type="text"],
                input[type="email"],
                input[type="number"],
                input[type="file"] {
                    width: 100%;
                    padding: 0.5rem;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    margin-bottom: 1rem;
                }

                .sumbutton {
                    background-color: #001778 !important;
                    width: 100%;
                    padding: 0.75rem;
                    color: #fff;
                    border: none;
                    border-radius: 0.25rem;
                    cursor: pointer;
                    transition: background-color 0.3s ease;

                }

                .sumbutton:hover {
                    background-color: #0056b3 !important;
                }

                .form-container {
                    margin-top: 2rem;
                }

                .form-group {
                    margin-bottom: 2rem;
                }

                .form-group:last-child {
                    margin-bottom: 0;
                }

                .form-group p {
                    margin-top: 0;
                }
                </style>
                @php
                $conditionResult = !$MyTrainings['Paid'] && !$MyTrainings['Invoiced'];
                $invoiced_not_paid = !$MyTrainings['Paid'] && $MyTrainings['Invoiced'];
                @endphp

                @if($conditionResult && count($lpo_attachments) == 0)
                <div class="row form-container">
                    <div class="col-md-6">
                        <label for="trainingattendeeslist">
                            Enter Attendees Manually
                        </label>
                        <p class="text-small text-primary">Upload Attendee List
                            i.e(Name,Email address,Phone Number)in csv file format.</p>
                        <form method="POST" action="{{ action('TrainingsController@addAttendee') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input class="form-control" type="hidden" name="regno" value="{{$MyTrainings['No']}}">
                            <div class="form-group">
                                <label for="Att_Name">Name</label>
                                <input type="text" class="form-control" name="Att_Name">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="Att_Email">Email</label>
                                        <input type="email" class="form-control" name="Att_Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Att_phone">Phone Number</label>
                                        <input type="number" class="form-control" name="Att_phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="Post_Address">Postal Address</label>
                                        <input type="text" class="form-control" name="Post_Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="KRA_PIN">KRA PIN</label>
                                        <input type="text" class="form-control" name="KRA_PIN">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info sumbutton"> <i class="fas fa-plus"></i> Add
                                Attendee</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="{{ action('TrainingsController@registertraining') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="hidden" name="regno"
                                        value="{{$MyTrainings['No']}}">
                                    <div class="form-group">
                                        <label for="trainingattendeeslist">Upload in csv file format</label>
                                        <p><a href="{{url('/TemplateDownloads')}}" class="text-primary"
                                                download="attendees">Click here to Download <i
                                                    class="fas fa-download text-success"></i> csv
                                                Template</a></p>
                                        <input class="form-control" type="file" name="trainingattendeeslist"
                                            id="trainingattendeeslist">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-info sumbutton" type="submit"><i
                                                    class="fas fa-upload"></i>
                                                Upload
                                                Attendee File</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card py-5 px-3 my-3" style="background-color: #E5E8E8">
                            <div class="row form-container">
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        To finish with the registration, you have to select either to <strong>pay now or
                                            pay
                                            later</strong> . If you
                                        choose to pay later, you'll need to upload an LPO.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-warning w-100" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop"><i class="fas fa-upload"></i>
                                        Pay Later</button>
                                </div>
                                @if(!$MyTrainings['Paid'] && !$MyTrainings['Invoiced'])
                                <div class="col-md-6">
                                    <form action="{{ action('TrainingsController@GetAttendeeInvoice') }}" method="post">
                                        @csrf
                                        <input class="form-control" type="hidden" name="regno"
                                            value="{{$MyTrainings['No']}}">
                                        <input class="form-control" type="hidden" name="total_payable"
                                            value="{{$MyTrainings['Total_Payable']}}">
                                        <button class="btn btn-info w-100" type="submit">Pay Now
                                            {{$MyTrainings['Currency']}} {{$MyTrainings['Total_Payable']}} <i
                                                class="fas fa-arrow-right"></i></button>

                                    </form>
                                </div>
                                @elseif(!$MyTrainings['Paid'] && $MyTrainings['Invoiced'])
                                <div class="col-md-6">
                                    <a class="btn btn-info w-100"
                                        href="/paymentgateway/{{$MyTrainings['Total_Payable']}}" type="button">Pay Now
                                        {{$MyTrainings['Currency']}} {{$MyTrainings['Total_Payable']}} <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($invoiced_not_paid && count($lpo_attachments) == 0)
                <div class="row form-container">
                    <div class="col-md-12">
                        <div class="card py-5 px-3 my-3" style="background-color: #E5E8E8">
                            <div class="row form-container">
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        To finish with the registration, you have to select either to <strong>pay now or
                                            pay
                                            later</strong> . If you
                                        choose to pay later, you'll need to upload an LPO.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-warning w-100" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop"><i class="fas fa-upload"></i>
                                        Pay Later</button>

                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-info w-100"
                                        href="/paymentgateway/{{$MyTrainings['Total_Payable']}}" type="button">Pay Now
                                        {{$MyTrainings['Currency']}} {{$MyTrainings['Total_Payable']}} <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($lpo_attachments) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="contentCard">
                            <h5>Attached LPOs</h5>
                            <hr>
                        </div>
                        <div class="row">
                            @foreach ($lpo_attachments as $lpo_attachments)
                            <div class="col-md-3">
                                <div class="fileDownloads mt-2">
                                    <div class="file-man-box" id="fileMan">
                                        <div class="file-img-box"><img src="{{ URL::asset('images/file.png')}}"
                                                alt="icon"></div>
                                        <div class="file-man-title">
                                            <h5 class="mb-0 text-overflow">
                                                {{$lpo_attachments['File_Name']}}.{{$lpo_attachments['File_Extension']}}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload
                    LPO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ action('TrainingsController@UploadAttachedDocument') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="hidden" name="regno" value="{{$MyTrainings['No']}}">
                    <div class="form-group">
                        <label for="trainingattendeeslist">Upload
                            LPO</label>
                        <input class="form-control" type="file" name="file" multiple>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info">Upload</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>

<script src="{{ URL::asset('libs/bootstrap-rating/bootstrap-rating.min.jss') }}"></script>

<script src="{{ URL::asset('js/pages/rating-init.jss') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>

<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
@endsection
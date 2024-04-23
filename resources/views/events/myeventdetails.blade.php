@extends('layouts.master')

@section('title') My Event Details @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="content-title mt-3">
            <h3>My Event Details </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    My Event Details
                </span></li>
        </ol>
        <div class="card event-card">
            <div class="col-8">
                <div class="event-poster">
                    <img src="{{ URL::asset('images//eventbanners/banner05.jpg') }}" data-holder-rendered="true">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="button-items" style="padding-left:10px;">
                        <button type="button" class="btn eventbutton">
                            <i class="fas fa-video font-size-16 align-middle mr-2"></i> Event Type:
                            {{$eventdetails['Event_Type']}}
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-1" style="padding:20px 5px 0px 10px;">Event: {{$eventdetails['Event_Name']}}</h4>
                    <p style="padding:10px 5px 20px 10px;">Event Description: {{$eventdetails['Event_Description']}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="pl-2 ml-1">Registration Start Date:
                        <span style="color: #011A77">{{$eventdetails['Registration_Start_Date']}}</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="pl-2 ml-1">Registration End Date:
                        <span style="color: #011A77"> {{$eventdetails['Registration_End_Date']}}</span>
                    </p>
                </div>
            </div>
            <div class="row px-2">
                @if ($eventdetails['Chargeable'] == 1)
                <div class="col-md-6">
                    <div class="bgs h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                        Kshs. {{$eventdetails['Total_Amount']}}

                        @if ($eventdetails['Inclusive_of_VAT'] == 1)
                        <p><b>Inc. of VAT: <span class="text-primary">Yes</span> </b></p>
                        @else
                        <p><b>Inc. of VAT: <span class="text-primary">No</span>
                            </b></p>
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
                        {{date_format(date_create($eventdetails['Event_Start_Date']),"d F Y")}}
                        @if ($eventdetails['Event_End_Date'])
                        to {{date_format(date_create($eventdetails['Event_End_Date']),"d F Y")}}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row my-3 px-2">
                <div class="col-md-7">
                    <div class="bgs text-dark h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                        <i class="fas dripicons-location"></i> Venue: {{$eventdetails['Venue']}}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="bgs h-100" style="background:#CACFD2; padding:15px; border-radius: 8px">
                        <i class="fas fa-clock"></i>
                        Time : {{$eventdetails['Event_Start_Time']}} to {{$eventdetails['Event_End_Time']}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">

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
                            @foreach ($data->Attendees as $item)
                            <tr>
                                <td>{{$item['Name']}}</td>
                                <td>{{$item['Email Address']}}</td>
                                <td>{{$item['Phone No']}}</td>
                                @if ($item['Attended'] == 1)
                                <td class="badge badge-success">Present</td>
                                @else
                                <td class="badge badge-danger">Absent</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
</div>
<!-- end row -->

@endsection

@section('script')
<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>
<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
@endsection
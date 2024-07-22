@extends('layouts.master')

@section('title') My Event List @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row pt-4" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>My Event List </h3>
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
                    <i class="fas fa-file-invoice"></i> My Events
                </a>
                <div class="dropdown-menu" aria-labelledby="breadcrumbDropdown">
                    <a class="dropdown-item" href="/upcomingevents/"><i class="fas fa-calendar-alt"></i>
                        Upcoming Events</a>
                    <a class="dropdown-item" href="/alltrainings/"><i class="fas fa-list"></i>
                        All
                        Trainings</a>
                    <a class="dropdown-item" href="/mytrainings/"><i class="fas fa-graduation-cap"></i>
                        My
                        Trainings</a>
                    <a class="dropdown-item" href="/newappointments"><i class="fas fa-calendar-plus"></i>
                        New
                        Appointments</a>
                    <a class="dropdown-item" href="/Rescheduledappointments"><i class="fas fa-sync-alt"></i>
                        Rescheduled
                        Appointment</a>
                    <a class="dropdown-item" href="/allappointments"><i class="fas fa-calendar"></i>
                        All
                        Appointments</a>
                    <a class="dropdown-item" href="/newservice/"><i class="fas fa-briefcase"></i> New
                        Service</a>
                    <a class="dropdown-item" href="/myservices/"><i class="fas fa-briefcase"></i> My
                        Services</a>

                    <a class="dropdown-item" href="/quotations"><i class="fas fa-clipboard-list"></i>
                        Quotations</a>
                    <a class="dropdown-item" href="/financials"><i class="fas fa-user"></i>
                        Invoices</a>
                    <a class="dropdown-item" href="/receipts"><i class="fas fa-receipt"></i>
                        Receipts</a>
                    <a class="dropdown-item" href="/getStatement/{{session('member_no')}}"><i
                            class="fas fa-money-check"></i>
                        Statement</a>
                    <a class="dropdown-item" href="/users"><i class="fas fa-users"></i>
                        Users</a>
                    <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ol>

    </div>
    <!-- end col -->

</div>
<!-- end row -->
<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <div class="">
                <h4 class="card-title">My Event List</h4>
                <table id="datatable-buttons"
                    class="table  table-striped table-bordered dt-responsive table-responsive-lg allTable"
                    cellspacing="1">
                    <thead>
                        <tr>
                            <th id="long">Event Description</th>
                            <th>Chargeable</th>
                            <th>No of Attendees</th>
                            <th>Total Payable</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item['Event_Description']}}</td>
                            <td>{{$item['Chargeable']}}</td>
                            <td>{{$item['No_of_Attendees']}}</td>
                            <td>{{number_format($item['Total_Payable'],2)}}</td>
                            <td colspan="1">
                                <a href="/myeventdetails/{{$item['No']}}" class="btn btn-success">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
@endsection
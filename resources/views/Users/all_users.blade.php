@extends('layouts.master')

@section('title') All Users @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

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
                    <i class="fas fa-users"></i> Users
                </a>
                <div class="dropdown-menu" aria-labelledby="breadcrumbDropdown">

                    <a class="dropdown-item" href="/upcomingevents/"><i class="fas fa-calendar-alt"></i>
                        Upcoming Events</a>
                    <a class="dropdown-item" href="/myevents/"><i class="fas fa-file-invoice"></i>
                        My Events</a>
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
                    <a class="dropdown-item" href="/getStatement/{{session('member_no')}}"><i
                            class="fas fa-money-check"></i>
                        Statement</a>
                    <a class="dropdown-item" href="/quotations"><i class="fas fa-clipboard-list"></i>
                        Quotations</a>
                    <a class="dropdown-item" href="/financials"><i class="fas fa-user"></i>
                        Invoices</a>
                    <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ol>
    </div>
    <!-- end col -->
</div>
<div class="row">
    <div class="col-md-12">
        <button type="button" onclick="window.location = '/addUser/Contact'"
            class="btn btn-primary waves-effect waves-light">
            <i class="fas fa-plus"></i> Add New User
        </button>
        &nbsp;&nbsp;

        @if ($user['membertype'] == 'ASSOCIATION')
        <button type="button" onclick="window.location = '/addUser/Associate'"
            class="btn btn-primary waves-effect waves-light">
            <i class="fas fa-plus"></i> Add Associated Company
        </button>
        @endif
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Roles</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                    <thead>
                        <tr>
                            <th id="long">Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Company</th>
                            <th>Account Type</th>
                            <th>Designation</th>
                            <th>Manage</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($DefaultContact as $item)
                        <tr>
                            <td>{{$item['Name']}}</td>
                            <td>{{$item['Email']}}</td>
                            <td>Super Administrator</td>
                            <td>{{$item['Name']}}</td>
                            <td>Main Account</td>
                            <td>Default Account</td>
                            <td><a href="#"><i class="fas fa-window-close" title="Delete"></i></a> &nbsp; <a href="#"><i
                                        class="fas fa-edit" title="Edit"></i></a></td>
                        </tr>
                        @endforeach
                        @foreach($MyContacts as $item)
                        <tr>
                            <td>{{$item['ContactName']}}</td>
                            <td>{{$item['E_Mail']}}</td>
                            <td>{{$item['Role']}}</td>
                            <td>{{$item['Company_Name']}}</td>
                            <td>{{$item['Account_Type']}}</td>
                            <td>{{$item['Designation']}}</td>
                            <td><a href="#"><i class="fas fa-window-close" title="Delete"></i></a> &nbsp; <a href="#"><i
                                        class="fas fa-edit" title="Edit"></i></a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
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
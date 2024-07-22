@extends('layouts.master')

@section('title') Trainings @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="container-fluid" id="holder">
    <div class="row">
        <div class="col-md-12">
            <div class="content-title mt-3">
                <h3> Trainings </h3>
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
                        <i class="fas fa-list"></i> Trainings
                    </a>
                    <div class="dropdown-menu" aria-labelledby="breadcrumbDropdown">
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
                        <a class="dropdown-item" href="/upcomingevents/"><i class="fas fa-calendar-alt"></i>
                            All Events</a>
                        <a class="dropdown-item" href="/myevents/"><i class="fas fa-file-invoice"></i>
                            My Events</a>
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Offered Trainings List</h4>
                    <table id="datatable-buttons"
                        class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                        <thead>
                            <tr>
                                <th>Programme Code</th>
                                <th>Programme Description</th>
                                <th>Department</th>
                                <th>Invoicing Method</th>
                                <th>Fees</th>
                                <th>Fees Inclusive of VAT</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Type of Training</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item['Programme_Code']}}</td>
                                <td>{{$item['Programme']}}</td>
                                <td>{{$item['Department']}}</td>
                                <td>{{$item['Invoicing_Method']}}</td>
                                <td>{{$item['Total_Payable']}}</td>
                                <td>
                                    @if ($item['Inclusive_of_VAT'] == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td>{{$item['Start_Date']}}</td>
                                <td>{{$item['End_Date']}}</td>
                                <td><span class="badge badge-danger">{{$item['Training_Type']}}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button style="font-size:13px;" type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="True">
                                            Actions<i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/viewtraining/{{$item['No']}}">View</a>
                                            <form method="POST"
                                                action="{{ action('TrainingsController@RegisterNewTraining') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input class="form-control" type="hidden" name="trainingno"
                                                    value="{{$item['No']}}">
                                                <input Type="hidden" name="trainingtype"
                                                    value="{{$item['Training_Type']}}">
                                                <button type="submit" class="btn btn-info dropdown-item">Register
                                                    <i class="fas fa-arrow-right"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
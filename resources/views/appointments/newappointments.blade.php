@extends('layouts.master')

@section('title') New Appointments @endsection
@section('css')

<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">

@endsection

@section('content')
<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3> New Appointments </h3>
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
                    <i class="fas fa-calendar-plus"></i> New Appointments
                </a>
                <div class="dropdown-menu" aria-labelledby="breadcrumbDropdown">
                    <a class="dropdown-item" href="/Rescheduledappointments"><i class="fas fa-sync-alt"></i>
                        Rescheduled
                        Appointment</a>
                    <a class="dropdown-item" href="/newservice/"><i class="fas fa-briefcase"></i> New
                        Service</a>
                    <a class="dropdown-item" href="/myservices/"><i class="fas fa-briefcase"></i> My
                        Services</a>

                    <a class="dropdown-item" href="/allappointments"><i class="fas fa-calendar"></i>
                        All
                        Appointments</a>
                    <a class="dropdown-item" href="/alltrainings/"><i class="fas fa-list"></i>
                        All
                        Trainings</a>
                    <a class="dropdown-item" href="/mytrainings/"><i class="fas fa-graduation-cap"></i>
                        My
                        Trainings</a>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="" action="{{ action('AppointmentsController@createAppointment') }}">
                    <h4 class="card-title">Set An Appointment</h4>

                    <div class="form-group row">
                        <label for="fullname" class="col-md-2 col-form-label">Appointment Date</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="appdate" placeholder="mm/dd/yyyy"
                                    data-provide="datepicker" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apptime" class="col-md-2 col-form-label">Appointment Time</label>
                        <div class="col-md-10">
                            <input class="form-control" type="time" name="apptime" placeholder="13:45:00" id="apptime"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="duration" class="col-md-2 col-form-label">Duration</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="duration" placeholder="30 Minutes" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">Appointment Type</label>
                        <div class="col-md-10">
                            <select class="form-control" name="type" required>
                                <option value="">--Select--</option>
                                @foreach ($Services as $service)
                                <option value="{{$service["Service_Code"]}}">
                                    {{$service["Service_Code"]}} - {{$service["Service_Description"]}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="remarks" class="col-md-2 col-form-label">Appointment Details</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="remarks"
                                placeholder="Briefly Describe the nature of the intended discussion" required>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dispatchto" class="col-md-2 col-form-label">Dispatch to</label>
                        <div class="col-md-10">
                            <select class="form-control" id="dispatchto" name="dispatchto" required>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Schedule Appointment</button>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
</form>

@endsection



@section('script')

<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>

<script>
//Load Employees
$.ajax({
    type: "GET",
    url: "/employees",
    success: function(result) {
        console.log(result);
        $("#dispatchto").html(result);
    }
});
</script>
@endsection
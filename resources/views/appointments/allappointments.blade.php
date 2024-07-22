@extends('layouts.master')

@section('title') Appointments @endsection
@section('css')

<link href="{{URL::asset('/libs/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
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
                    <i class="fas fa-calendar"></i> All
                    Appointments
                </a>
                <div class="dropdown-menu" aria-labelledby="breadcrumbDropdown">
                    <a class="dropdown-item" href="/newappointments"><i class="fas fa-calendar-plus"></i>
                        New
                        Appointments</a>
                    <a class="dropdown-item" href="/Rescheduledappointments"><i class="fas fa-sync-alt"></i>
                        Rescheduled
                        Appointment</a>
                    <a class="dropdown-item" href="/newservice/"><i class="fas fa-briefcase"></i> New
                        Service</a>
                    <a class="dropdown-item" href="/myservices/"><i class="fas fa-briefcase"></i> My
                        Services</a>
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
    <div class="col-sm-12 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="newappointment">
                    <button type="button" onclick="window.location = '/newappointments'" class="btn">
                        <i class="fas fa-plus"></i>
                        <font color="#FFFFFF">New Appointment</font>
                    </button>
                </div>
                <p>Upcoming Appointments</p>

                <div class="row AllAppointments">
                    @foreach ($MyAppointments as $item )
                    <!-- Loop Announcements from here -->
                    <div class="col-12">
                        <h5 class="atitle">{{$item['Remarks']}}</h5>
                        <p class="adate"><i class="fas fa-calendar-alt"></i>{{$item['Appointment_Date']}}</p>
                        <p class="atime"><i class="far fa-clock"></i>{{$item['Appointment_Time']}}</p>
                        <p class="atime"><i
                                class="far fa-clock"></i>{{$item['Rescheduled'] ? 'Rescheduled' : $item['Status']}}</p>
                        <div class="viewappointment">
                            <button style="padding-right: 32px" type="button" class="btn btn-primary" id="View_details"
                                data-toggle="modal" data-target=".appointment" data-no="{{$item['Appointment_No']}}"><i
                                    class="fas fa-eye"></i> View Appointment
                            </button>
                            @if ($item['Rescheduled'])
                            <p></p>
                            <a style="color: white;" class="btn btn-success"
                                href="/confirmappointment/{{$item['Appointment_No']}}/{{$item['Suggested_Date']}}"
                                id="confirm_appointment"><i class="fas fa-eye"></i> Confirm Appointment
                            </a>
                            <p></p>
                            <a style="color: white; padding-right: 18px" class="btn btn-danger"
                                href="/cancelappointment/{{$item['Appointment_No']}}/{{$item['Suggested_Date']}}"
                                id="cancel_appointment"><i class="fas fa-eye"></i> Cancel Appointment
                            </a>
                            @endif
                        </div>
                        <div class="adivider"></div>
                    </div>
                    <!-- End of Announcements Loop -->
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>

                <div style='clear:both'></div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Modal -->
<div class="modal fade appointment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Appointment</h5>

                <div class="newappointment1"><button type="button" onclick="window.location = '/newappointments'"
                        class="btn">
                        <i class="fas fa-plus"></i>
                        <font color="#FFFFFF">New Appointment</font>
                    </button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Title-->
                <h4 id="Apptitle"><b></b></h4>
                <p id="Apptype"><b></b></p>
                <div class="row">
                    <div class="col-6" id="Appdate"><i class="fas fa-calendar-alt"></i> </div>
                    <div class="col-6" id="Apptime"><i class="fas fa-clock"></i> </div>
                </div>
                <div class="spacer-10"></div>
                <div class="row">
                    <div class="col-12">
                        <p id="Appdescription"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- end row -->
@endsection

@section('script')
<!-- plugin js -->
<script src="{{URL::asset('/libs/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('/libs/fullcalendar/fullcalendar.min.js')}}"></script>

<script>
var NAVEvents = {
    !!json_encode($Events) !!
};
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.AllAppointments').on('click', '#View_details', function(e) {
        e.preventDefault();
        var no = $(this).data('no');

        $('#Appno').empty();
        $('#Apptitle').empty();
        $('#Apptype').empty();
        $('#Appdate').empty();
        $('#Apptime').empty();
        $('#Appdescription').empty();

        $('#Appno').append(no);

        $.ajax({
            url: '/viewappointment/' + no,
            method: "GET",
            success: function(response) {
                var details = $.parseJSON(response);
                console.log(details);

                var MyDetails = details.MyDetails[0];

                if (MyDetails !== null) {
                    $('#Apptitle').append(MyDetails.Appointment_Type);
                    $('#Apptype').append(MyDetails.Appointment_Type);
                    $('#Appdate').append('<i class="fas fa-calendar-alt"></i> ' + MyDetails
                        .Appointment_Date);
                    $('#Apptime').append('<i class="fas fa-clock"></i> ' + MyDetails
                        .Appointment_Time);
                    $('#Appdescription').append(MyDetails.Remarks);
                } else {
                    $('#Appno').empty();
                    $('#Apptitle').empty();
                    $('#Apptype').empty();
                    $('#Appdate').empty();
                    $('#Apptime').empty();
                    $('#Appdescription').empty();
                }
            }
        })
    });
});
</script>

<script>
eventClick: function(info) {
    info.jsEvent.preventDefault();

    if (info.event.url) {
        window.open(info.event.url);
    }
}
</script>

<!-- Calendar init -->
<script src="{{URL::asset('/js/pages/calendar.init.js')}}"></script>
@endsection
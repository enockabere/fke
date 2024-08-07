@extends('layouts.master')

@section('title') Financials @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>Invoices </h3>
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
                    <i class="fas fa-user"></i> Invoices
                </a>
                <div class="dropdown-menu" aria-labelledby="breadcrumbDropdown">
                    <a class="dropdown-item" href="/receipts"><i class="fas fa-receipt"></i>
                        Receipts</a>
                    <a class="dropdown-item" href="/getStatement/{{session('member_no')}}"><i
                            class="fas fa-money-check"></i>
                        Statement</a>
                    <a class="dropdown-item" href="/quotations"><i class="fas fa-clipboard-list"></i>
                        Quotations</a>
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
                    <a class="dropdown-item" href="/users"><i class="fas fa-users"></i>
                        Users</a>
                    <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ol>
    </div>
</div>
<div class="row mb-4" id="holder">
    <div class="col-md-7 col-sm-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="sent">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="c-head">
                                        <h4>{{number_format($MyProfile['Invoices_Sent'])}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="c-icon  mx-auto text-center">
                                        <i class="fas fa-check" style="color: #011A77;font-size:20px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="c-text">
                                        <p>Invoice(s) Sent</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6" id="kad">
                        <div class="pend">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="c-head">
                                        <h4>{{number_format($MyProfile['Invoices_Pending'])}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="c-icon  mx-auto text-center">
                                        <i class="fas fa-question-circle" style="color: #011A77;font-size:20px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="c-text">
                                        <p>Pending Invoice(s)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="paid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="c-head">
                                        <h4>{{number_format($MyProfile['Invoices_Paid'])}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="c-icon  mx-auto text-center">
                                        <i class="fas fa-check-double" style="color: #011A77;font-size:20px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="c-text">
                                        <p>Paid Invoice(s)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="kad">
                        <div class="unpaid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="c-head">
                                        <h4>{{number_format($MyProfile['Invoices_Unpaid'])}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="c-icon  mx-auto text-center">
                                        <i class="fas fa-exclamation-circle" style="color: #011A77;font-size:20px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="c-text">
                                        <p>Unpaid Invoice(s)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-body" id="f-kad">
                <h5 style="color: #FFFFFF;">Total Invoiced Amount</h5>
                <h3 style="color: #FFFFFF">Ksh. {{number_format($totalbillsdue, 2)}}</h3>

                <h5 style="color: #FFFFFF;">Total Receipted Amount</h5>
                <h3 style="color: #FFFFFF">Ksh. {{number_format($totalreceipts, 2)}}</h3>
                <div class="spacer-20"></div>
                @if (($MyProfile['Member_Balances'] + $MyProfile['Balance']) > 0)
                <a href="/paymentgateway/{{ ($MyProfile['Member_Balances'] + $MyProfile['Balance']) }}"
                    class="btn btn-primary" style="background-color:#605253; color:#FFBB54;"> <i
                        class="bx bx-wallet-alt"></i> Pay Now </a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Payment History</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive allTable table-responsive-lg">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <!--Loop From Here -->
                        @foreach ($invoicedata as $item)
                        <tr>
                            <td>{{$item['InvoiceNo']}}</td>
                            <td>{{$item['Description']}}</td>
                            <td>{{$item['Date_Posted']}}</td>
                            <td>{{number_format($item['Amount'])}}</td>
                            <td>
                                Paid
                            </td>
                            <td>
                                <a href="/downloadinvoice/{{$item['InvoiceNo']}}" target="_blank"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Preview
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
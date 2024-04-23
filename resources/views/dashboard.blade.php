@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

@component('layouts.breadcrumb')
@slot('title') Dashboard @endslot

@endcomponent



<div class="row" id="holder">
    <div class="col-lg-12 announcements">
        <div class="card bg-primary text-white-50">
            <div class="card-body">
                <button type="button" class="btn btn-primary" id="dash_btns">
                    <b>Announcements</b>
                </button>
                <div class="spacer-20"></div>
                <p>{{$Announcement['Summary']}}</p>

                <a style="color: #FFFFFF" href="/notifications/">Read More</a>
            </div>
        </div>
    </div>
</div>
<div class="row  row-flex mb-4">
    <div class="col-md-6" id="now">
        <div class="card h-100" id="cards1">
            <div class="body">
                <a type="button" href="/upcomingevents/" class="btn btn-primary" id="dash_btns">
                    Upcoming Events
                </a>
                <div class="spacer-20"></div>
                <div class="norms">
                    <i class="fas fa-briefcase"></i> {{$UpcomingEvent['Event_Name']}} </br>
                    <i class="fas fa-calendar-alt"></i> {{$UpcomingEvent['Event_Start_Date']}} </br>
                    <i class="dripicons-location"> </i> {{$UpcomingEvent['Venue']}}
                </div>
                <div class="spacer-20"> </div>
                <a href="/viewevent/{{$UpcomingEvent['Event_No']}}" class="btn btn-primary"
                    style="background-color:#FFFFFF; color:#194039;">View
                    Event</a>
            </div>
        </div>
    </div>
    <div class="col-md-6" id="now">
        <div class="card h-100" id="cards2">
            <div class="card-body" style="background-image:url({{ URL::asset('images/invoice.jpg')}})">
                <h5 style="color: #FFFFFF;">Balance Due</h5>
                <h3 style="color: #FFFFFF">Ksh.
                    {{($MyProfile['Member_Balances'] + $MyProfile['Balance']) > 0 ? number_format(($MyProfile['Member_Balances'] + $MyProfile['Balance']), 2) : number_format(0,2)}}
                </h3>

                <div class="norms">
                    <p>As at: {{$user['today']}} </p>
                </div>

                @if ((($MyProfile['Member_Balances'] + $MyProfile['Balance']) > 0) && ($user['Category_code'] !==
                'AFF'))
                <a href="/paymentgateway/{{($MyProfile['Member_Balances'] + $MyProfile['Balance'])}}"
                    class="btn btn-primary" style="background-color:#FFFFFF; color:#011979;"> <i
                        class="bx bx-wallet-alt"></i> Pay Now</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="media">
                    <div class="avatar-sm font-size-20 mr-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-tag-plus-outline"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <div class="font-size-16 mt-2">Trainings</div>
                    </div>
                </div>
                <div class="spacer-20"></div>
                <div class="spacer-20"></div>
                <h4 class="mt-4">{{$TrainingCount}} Active Trainings</h4>
                <div class="spacer-20"></div>
                <div class="spacer-20"></div>
                <div class="row">
                    <div class="col-md-7">
                        <a href="/mytrainings/" class="btn btn-primary btn-sm">View All</a>
                    </div>
                    <div style="padding-top: 50px;"></div>
                    <div class="col-md-5 align-self-center">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4" id="kad">
        <div class="card h-100">
            <div class="card-body">
                <div class="media">
                    <div class="avatar-sm font-size-20 mr-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-tag-plus-outline"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <div class="font-size-16 mt-2">Services</div>
                    </div>
                </div>
                <div class="spacer-20"></div>
                <div class="spacer-20"></div>
                <h4 class="mt-4">{{$ServicesCount}} Active Service Requests</h4>
                <div class="spacer-20"></div>
                <div class="spacer-20"></div>
                <div class="row">
                    <div class="col-md-7">
                        <a href="/myservices/active" class="btn btn-primary btn-sm">View All</a>
                    </div>
                    <div style="padding-top: 50px;"></div>
                    <div class="col-md-5 align-self-center">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 20%"
                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4" id="kad">
        <div class="card bg-primary h-100">
            <div class="card-body">
                <div class="text-white-50">
                    <h5 class="text-white">Request Assistance</h5>
                    <p>Request assistance when you get stuck by clicking below. We will try and respond as soon as
                        possible.</p>
                    <div class="spacer-20"></div>
                    <div>
                        <a href="/newservice/" class="btn btn-outline-contact btn-sm">Contact Us</a>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-8">
                        <div class="mt-4">
                            <img src="{{ URL::asset('images/widget-img.png')}}" width="75%" alt=""
                                class="img-fluid mx-auto d-block">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Transactions</h4>

                <div>
                    <table id="datatable-buttons"
                        class="table table-striped table-bordered dt-responsive allTable table-responsive-lg">
                        <thead>
                            <tr>
                                <th id="long">Transaction No</th>
                                <th>Posting Date</th>
                                <th>Document Type</th>
                                <th>Document No</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MyLedgerEntries as $item)
                            <tr>
                                <td>{{$item['Transaction_No']}}</td>
                                <td>{{$item['Posting_Date']}}</td>
                                <td>{{$item['Document_Type']}}</td>
                                <td>{{$item['Document_No']}}</td>
                                <td>{{$item['Description']}}</td>
                                <td><span class="badge badge-soft-success font-size-12">{{$item['Amount']}}</span></td>
                                <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mb-2">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title mb-4">Downloads</h4>
                <ul class="inbox-wid list-unstyled">
                    @foreach($MembershipTemps as $item)
                    <li class="inbox-list-item">
                        <a href="/download/{{$item['ID']}}/{{$item['File_Type']}}/{{$item['File_Extension']}}">
                            <div class="media">

                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-16 mb-1">{{$item['File_Name']}}</h5>

                                </div>
                                <div class="font-size-12 ml-2">
                                    <i class="fas fa-download"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div class="text-center">
                    <a href="/alldownloads" class="btn btn-primary btn-sm">Load more</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" id="kad">
        <div class="card h-100">
            <form action="{{ action("GeneralController@RequestService") }}">
                <div class="card-body">
                    <h4 class="card-title mb-4">Request</h4>
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label">Type Of Request</label>
                        <div class="col-md-12">
                            <select class="form-control" name="service">
                                <option value="">Select the type Of request</option>
                                <option value="Training">Training</option>
                                <option value="Service">Service</option>
                                <option value="Appointment">Appointment</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label>Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" data-provide="datepicker"
                                data-date-autoclose="true">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <!-- input-group -->
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm" type="submit">Request Service</button>
                    </div>
                </div>
            </form>
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
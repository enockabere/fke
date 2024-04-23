@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

     @component('layouts.breadcrumb')
         @slot('title') Dashboard  @endslot

     @endcomponent
     <div class="page-content">


<div class="row">
            <div class="col-lg-12">
                <div class="card bg-primary text-white-50">
                    <div class="card-body">
                         <button type="button" class="btn btn-primary" style="padding-right: 10px; background-color: #FFFFFF;"><font color="#011979"><b>Announcements</b></font></button>
                         <div class="spacer-20"></div>
                         <p>All members are required to register their list afresh as per new FKE instructions</p>

                        <a style="color: #FFFFFF" href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
<div class="col-lg-6">
                <div class="card bg-dark text-light">
                    <div class="card-body" style="background-image:{{ URL::asset('images/events.jpg')}}">
                        <button type="button" class="btn btn-primary" style="padding-right: 10px; background-color: #FFFFFF;"><font color="#011979"><b>Upcoming Events</b></font></button>
                        <div class="spacer-20"></div>
                        <i class="fas fa-calendar-alt"></i> Sunday, 12 June 2021 <i class="dripicons-location"> </i> Villa Rosa Kempinski
                        <div class="spacer-20"> </div>
                         <a href="#" class="btn btn-primary" style="background-color:#FFFFFF; color:#194039;">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card bg-dark text-light">
                    <div class="card-body" style="background-image: {{ URL::asset('images/events.jpg')}}">
                        <h5 style="color: #FFFFFF;">Invoice Due</h5>
                        <h3 style="color: #FFFFFF">Ksh. 5,000.00</h3>

                        <p> Friday, February 12th 2021, 9:24 AM</p>

                         <a href="#" class="btn btn-primary" style="background-color:#605253; color:#FFBB54;"> <i class="bx bx-wallet-alt"></i> Pay Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
       <div class="col-lg-4">
            <div class="card">
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
                        <div class="spacer-20"></div><div class="spacer-20"></div>
                        <h4 class="mt-4">1 Pending</h4>
                        <div class="spacer-20"></div><div class="spacer-20"></div>
                        <div class="row">
                            <div class="col-7">
                                <a href="#" class="btn btn-primary btn-sm">View All</a>
                            </div>
                            <div style="padding-top: 50px;"></div>
                            <div class="col-5 align-self-center">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
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
                        <div class="spacer-20"></div><div class="spacer-20"></div>
                        <h4 class="mt-4">1 Pending</h4>
                        <div class="spacer-20"></div><div class="spacer-20"></div>
                        <div class="row">
                            <div class="col-7">
                                <a href="#" class="btn btn-primary btn-sm">View All</a>
                            </div>
                            <div style="padding-top: 50px;"></div>
                            <div class="col-5 align-self-center">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
        <div class="card bg-primary">
                    <div class="card-body">
                        <div class="text-white-50">
                            <h5 class="text-white">Request Assistance</h5>
                            <p>Request assistance when you get stuck by clicking below. We will try and respond as soon as possible.</p>
                            <div class="spacer-20"></div>
                            <div>
                                <a href="#" class="btn btn-outline-success btn-sm">Contact Us</a>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-8">
                                <div class="mt-4">
                                    <img src="assets/images/widget-img.png" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>



    </div>

    <div class="row">
    <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Latest Transactions</h4>

                        <div class="table-responsive">
                            <table class="table table-centered">
                                <thead>
                                    <tr>
                                        <th scope="col">Application ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Booked By</th>
                                        <th scope="col" colspan="2">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#0012451</td>
                                        <td>15/01/2020</td>
                                        <td>Training</td>
                                        <td>Timothy Wandie</td>
                                        <td><span class="badge badge-soft-success font-size-12">Paid</span></td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                   <tr>
                                        <td>#0012451</td>
                                        <td>15/01/2020</td>
                                        <td>Training</td>
                                        <td>Timothy Wandie</td>
                                        <td><span class="badge badge-soft-danger font-size-12">Pending</span></td>
                                        <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
<div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Downloads</h4>

                        <ul class="inbox-wid list-unstyled">
                            <li class="inbox-list-item">
                                <a href="#">
                                    <div class="media">

                                        <div class="media-body overflow-hidden">
                                            <h5 class="font-size-16 mb-1">HR Policy Document</h5>

                                        </div>
                                        <div class="font-size-12 ml-2">
                                            <i class="fas fa-download"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="inbox-list-item">
                                <a href="#">
                                    <div class="media">

                                        <div class="media-body overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Dismissal Letter</h5>

                                        </div>
                                        <div class="font-size-12 ml-2">
                                            <i class="fas fa-download"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="inbox-list-item">
                                <a href="#">
                                    <div class="media">

                                        <div class="media-body overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Training Manual</h5>

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
            <div class="col-lg-6">
<div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Request</h4>
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label">Type Of Service</label>
                            <div class="col-md-12">
                                <select class="form-control">
                                    <option>Type Of Service</option>
                                    <option>Training</option>
                                    <option>Appointment</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                                <label>Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <!-- input-group -->
                            </div>
                        <div class="text-center">
                            <a href="#" class="btn btn-primary btn-sm">Request Service</a>
                        </div>
                    </div></div>
            </div>
    </div>


</div>


@endsection

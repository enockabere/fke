@extends('layouts.master')

@section('title') Upcoming Events @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>Upcoming Event </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Upcoming Event
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Up Coming Events List</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                    <thead>
                        <tr>
                            <th>Event Start Date</th>
                            <th id="long">Event Name</th>
                            <th>Event End Date</th>
                            <th>Registration End Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item['Event_Start_Date']}}</td>
                            <td>{{$item['Event_Name']}}</td>

                            <td>{{$item['Event_End_Date']}}</td>
                            <td>{{$item['Registration_End_Date']}}</td>
                            <td>
                                <div class="btn-group">
                                    <button style="font-size:15px;" type="button"
                                        class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        Actions<i style="margin-left:-2px;" class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/viewevent/{{$item['Event_No']}}">View</a>
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
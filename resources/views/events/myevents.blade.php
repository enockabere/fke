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
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    My Event List
                </span></li>
        </ol>
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
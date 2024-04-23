@extends('layouts.master')

@section('title')My Case List @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>My Case List </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    My Case List
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Case List</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered allTable dt-responsive table-responsive">
                    <thead>
                        <tr>
                            <th>Case No</th>
                            <th>Issue In Dispute</th>
                            <th>Parties</th>
                            <th>Officer Handling</th>
                            <th>Date Filed</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item['Case_No']}}</td>
                            <td>{{$item['Issue_in_Dispute']}}</td>
                            <td>{{$item['Parties']}}</td>
                            <td>{{$item['Officer_Handling']}}</td>
                            <td>{{$item['Date_Filed']}}</td>
                            <td>
                                <a href="/MyCaseDetails/{{$item['No']}}" class="btn btn-success btn-sm">
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
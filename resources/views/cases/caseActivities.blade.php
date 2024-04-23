@extends('layouts.master')

@section('title')My Case List @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="content-title mt-3">
            <h3>My Case Activities </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    My Case Activities
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">My Case Activities</h4>
                <table id="datatable-buttons" class="table wrap table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Case No</th>
                            <th>Issue In Dispute</th>
                            <th>Parties</th>
                            <th>Activity Date</th>
                            <th>Activity Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item['No']}}</td>
                            <td>{{$item['Case_Description']}}</td>
                            <td>{{$item['Parties']}}</td>
                            <td>{{$item['Activity_Date']}}</td>
                            <td>{{$item['Activity_Details']}}</td>
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
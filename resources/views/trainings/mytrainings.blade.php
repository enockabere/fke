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
                <h3> Scheduled Trainings </h3>
            </div>
            <ol class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                            class="fa fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                        Scheduled Trainings
                    </span></li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Training List</h4>
                    <table id="datatable-buttons"
                        class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                        <thead>
                            <tr>
                                <th>Programme Code</th>
                                <th>Programme Description</th>
                                <th>Module Description</th>
                                <th>Training Date</th>
                                <th>Total Payable</th>
                                <th>Cost Inc. of VAT</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item['Programme_Code']}}</td>
                                <td>{{$item['Programme_Description']}}</td>
                                <td>{{$item['Module_Description']}}</td>
                                <td>{{$item['Training_Type']}}</td>
                                <td>{{$item['Total_Payable']}}</td>
                                <td>
                                    @if ($item['VAT_Inclusive'] == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td><span class="badge badge-danger">Ended</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Actions <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/mytrainingdetails/{{$item['No']}}">View</a>
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
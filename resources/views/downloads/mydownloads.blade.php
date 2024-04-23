@extends('layouts.master')

@section('title') Downloads @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
@component('layouts.breadcrumb')
@slot('title') My Downloads @endslot

@endcomponent
<div class="row" id="holder">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Download List</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive allTable">
                    <thead>
                        <tr>
                            <th id="long">Download ID</th>
                            <th>Title </th>
                            <th>Document Type</th>
                            <th>Cost</th>
                            <th>Cost Inc. of VAT</th>
                            <th>Download Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($Documents as $Document)
                        <tr>
                            <td>{{$Document['ID']}}</td>
                            <td>{{$Document['File_Name']}}</td>
                            <td>{{$Document['Programme_Code']}}</td>
                            <td>{{$Document['Chargeable_Amount']}}</td>
                            <td>
                                @if ($Document['VAT_Inclusive'] == 1)
                                True
                                @else
                                False
                                @endif
                            </td>
                            <td>{{date_format(date_create($Document['Attached_Date']),"d F Y")}}</td>
                            <td>
                                <a
                                    href="/download/{{$Document['ID']}}/{{$Document['File_Type']}}/{{$Document['File_Extension']}}">
                                    <i class="fa fa-download" aria-hidden="true"></i>
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
@extends('layouts.master')

@section('title') Financials @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="content-title mt-3">
            <h3>Customer Statement </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Customer Statement
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Customer Statement</h4>
                <embed src="{{ action('FinancialsController@getStatement', ['id'=> session('member_no')]) }}"
                    style="width:600px; height:800px;" frameborder="0">
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
@extends('layouts.master')

@section('title') Document Details @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
@component('layouts.breadcrumb')
@slot('title') Document Details @endslot

@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="trainingheader">
                    <h4>{{$document['Title']}}</h4>
                    <p>{{$document['Body']}}</p>
                    <p>Date Created: {{$document['Time_Created']}}</p>
                </div>
            </div>
        </div>
    </div>

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
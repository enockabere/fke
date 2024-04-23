@extends('layouts.master')

@section('title') Documents List @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
@component('layouts.breadcrumb')
@slot('title') Documents List @endslot
@endcomponent
<div class="row align-center">
    <div class="col-3">
        <select class="form-control" name="searchBy" id="searchBy">
            <option value="1" selected="{{isset($_GET['by']) && $_GET['by'] == 1? 'selected':''}}">Search by Title
            </option>
            <option value="2" selected="{{isset($_GET['by']) && $_GET['by'] == 2? 'selected':''}}">Search by Content
            </option>
        </select>
    </div>
    <div class="col-6">
        <input class="form-control" name="search" id="search" value="{{isset($_GET['search'])?$_GET['search']:'' }}"
            placeholder="">
    </div>
    <div class="col-3">
        <button type="button" id="btnSearch" class="btn btn-primary mt-2 mb-2"
            onclick="searchDocuments()">Search</button>
    </div>
</div>
<div class="row" id="holder">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Documents List</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item['Code']}}</td>
                            <td>{{$item['Title']}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        Actions <i class="mdi mdi-dots-vertical ml-2"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/fke-document/{{$item['Code']}}">View</a>
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
<script>
function searchDocuments() {
    var searchValue = document.getElementById('search').value;
    var searchBy = document.getElementById('searchBy').value;
    location.href = '/fke-document?search=' + searchValue + '&by=' + searchBy;
}
</script>
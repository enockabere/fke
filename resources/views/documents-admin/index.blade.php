@extends('layouts.master')

@section('title') Documents Admin @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="container-fluid" id="holder">
    <div class="row">
        <div class="col-md-12">
            <div class="content-title mt-3">
                <h3> Documents Admin </h3>
                <button type="button" class="btn-primary" onclick="window.location = '/documents-admin/create'"
                    class="btn">
                    <i class="fas fa-plus"></i>
                    <font color="#FFFFFF">New Doc</font>
                </button>
            </div>
            <ol class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                            class="fa fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                        Documents Admin
                    </span></li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Documents Admin List</h4>
                    <table id="datatable-buttons"
                        class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sequence</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $record)
                            <tr>
                                <td>{{$record['Code']}}</td>
                                <td>{{$record['Title']}}</td>
                                <td>{{$record['Category']}}</td>
                                <td>{{$record['Sequence']}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button style="font-size:13px;" type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="True">
                                            Actions<i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/documents-admin/show-edit/{{$record['Code']}}">View/Edit</a>
                                            <form method="POST"
                                                action="{{ action('DocumentsAdminController@deleteDoc') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input class="form-control" type="hidden" name="code"
                                                    value="{{$record['Code']}}">
                                                <button type="submit" class="btn btn-info dropdown-item">Delete
                                                    <i class="fas fa-arrow-right"></i></button>
                                            </form>
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
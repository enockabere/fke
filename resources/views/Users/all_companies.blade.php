@extends('layouts.master')

@section('title') All Users @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

@component('layouts.breadcrumb')
@slot('title') User Management @endslot
@slot('li_1') All Users @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <button type="button" onclick="window.location = '/addUser/Contact'"
            class="btn btn-primary waves-effect waves-light">
            <i class="fas fa-plus"></i> Add New User
        </button>
        &nbsp;&nbsp;

        @if ($user['membertype'] == 'ASSOCIATION')
        <button type="button" onclick="window.location = '/addUser/Associate'"
            class="btn btn-primary waves-effect waves-light">
            <i class="fas fa-plus"></i> Add Associated Company
        </button>
        @endif
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Associated Companies</h4>


                <table class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0;font-size:13px; width: 100%;">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Website</th>
                            <th>Address</th>
                            <th>Post Code</th>
                            <th>City</th>
                            <th>Manage</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($MyCompanies as $item)
                        <tr>
                            <td>{{$item['ContactName']}}</td>
                            <td>{{$item['E_Mail']}}</td>
                            <td>{{$item['Phone_No']}}</td>
                            <td>{{$item['Home_Page']}}</td>
                            <td>{{$item['Address']}}</td>
                            <td>{{$item['Post_Code']}}</td>
                            <td>{{$item['City']}}</td>
                            <td><a href="#"><i class="fas fa-window-close" title="Delete"></i></a> &nbsp; <a href="#"><i
                                        class="fas fa-edit" title="Edit"></i></a></td>
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

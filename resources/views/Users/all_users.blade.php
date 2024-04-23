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

<div class="row" id="holder">
    <div class="col-md-12">
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
                <h4 class="card-title">User Roles</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive allTable">
                    <thead>
                        <tr>
                            <th id="long">Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Company</th>
                            <th>Account Type</th>
                            <th>Designation</th>
                            <th>Manage</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($DefaultContact as $item)
                        <tr>
                            <td>{{$item['Name']}}</td>
                            <td>{{$item['Email']}}</td>
                            <td>Super Administrator</td>
                            <td>{{$item['Name']}}</td>
                            <td>Main Account</td>
                            <td>Default Account</td>
                            <td><a href="#"><i class="fas fa-window-close" title="Delete"></i></a> &nbsp; <a href="#"><i
                                        class="fas fa-edit" title="Edit"></i></a></td>
                        </tr>
                        @endforeach
                        @foreach($MyContacts as $item)
                        <tr>
                            <td>{{$item['ContactName']}}</td>
                            <td>{{$item['E_Mail']}}</td>
                            <td>{{$item['Role']}}</td>
                            <td>{{$item['Company_Name']}}</td>
                            <td>{{$item['Account_Type']}}</td>
                            <td>{{$item['Designation']}}</td>
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
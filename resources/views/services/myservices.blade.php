@extends('layouts.master')

@section('title') My Services List @endsection
@section('css')

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3> My Services List </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    My Services List
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Services List</h4>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                    <thead>
                        <tr>
                            <th>Service Code</th>
                            <th>Service Name</th>
                            <th>Service Description</th>
                            <th>Amount Chargeable</th>
                            <th>Inclusive of VAT</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item['Service_Code']}}</td>
                            <td>{{$item['Service_Name']}}</td>
                            <td>{{$item['Service_Description']}}</td>
                            <td>{{$item['Amount_Chargeable']}}</td>
                            <td>
                                @if ($item['Inclusive_of_VAT'] == 1)
                                True
                                @else
                                False
                                @endif
                            </td>
                            <td>{{$item['Status']}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        Actions <i class="mdi mdi-dots-vertical ml-2"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/servicedetails/{{$item['No']}}">View</a>
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
<script>
$(document).ready(function() {
    window.addEventListener('scroll', (e) => {
        const nav = document.querySelector('.navbar');
        if (window.pageYOffset > 0) {
            nav.classList.add("add-shadow");
        } else {
            nav.classList.remove("add-shadow");
        }
    });

});
</script>
@endsection

@section('script')
<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>
<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
@endsection
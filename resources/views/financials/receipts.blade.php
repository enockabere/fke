@extends('layouts.master')

@section('title') Financials @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>Receipts </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Receipts
                </span></li>
        </ol>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Payment History</h4>
                <button type="button" class="btn btn-warning my-2" data-toggle="modal" data-target="#ClaimsModal">
                    Claim a Payment
                </button>
                <table id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive table-responsive-lg allTable">
                    <thead>
                        <tr>
                            <th>Receipt No</th>
                            <th>External Reference No.</th>
                            <th>Mode of Payment</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <!--Loop From Here -->
                        @foreach ($receipts as $item)
                        <tr>
                            <td>{{$item['No']}}</td>
                            <td>{{$item['Cheque_Deposit_Slip_No']}}</td>
                            <td>{{$item['Pay_Mode']}}</td>
                            <td>{{$item['Cheque_Deposit_Slip_Date']}}</td>
                            <td>{{number_format($item['Amount'])}}</td>
                            <td>
                                <a href="/downloadreceipt/{{$item['No']}}" target="_blank"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Download Receipt
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="ClaimsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Claim A Payment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{action('FinancialsController@claimPayment')}}" method="POST" autocomplete="off"
                    id="submitlogin" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="refno">Transaction Reference Number</label>
                        <input id="refno" type="text" class="form-control @error('refno') is-invalid @enderror"
                            name="refno" value="{{ old('refno') }}" required autocomplete="refno" autofocus>
                        @error('refno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="proof">Attach your proof of payment</label>
                        <input id="proof" type="file" class="form-control @error('proof') is-invalid @enderror"
                            name="proof" value="{{ old('proof') }}" required autocomplete="proof" autofocus>
                        @error('proof')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success btn-block waves-effect waves-light" id="login"
                            type="submit">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
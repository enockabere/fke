@extends('layouts.master')

@section('title') Payments @endsection
@section('css')


@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>Payment Gateway </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Payment Gateway
                </span></li>
        </ol>
    </div>
</div>
<div class="row" id="holder">
    <div class="col-md-5">
        <div class="summarycard">
            <h4 class="summarytitle">Total Pay</h4>
            <h2 class="summarycost">Ksh. {{$Total_Payable ? number_format($Total_Payable, 2) : number_format(0,2)}}</h2>
            <p class="summary-description">Choose from the payment options available to proceed. Your payment will be
                processed immediately. </p>
            <div class="summaryalertcard">
                <i class="fas fa-exclamation-circle" style="padding-top: 10px;
                padding-left: 10px; color: #FFFFFF;"></i>
                <p class="summaryalert" style="padding:10px 20px 20px 10px; color: #FFFFFF;"> For Cheque and bank
                    transfer, kindly allow for verififcation before your account us updated.</p>
            </div>
            <div class="spacer-10"></div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="paymentoptions">

            <div class="paymenttitle">
                <p>Payment Details</p>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <!-- <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#mpesa" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block"><i class=""><img src="{{ URL::asset('images/mpesa.png')}}"
                                    width="15%"></i> M-PESA</span>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#creditcard" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block"><i class="mdi mdi-credit-card"></i> Credit Card</span>
                    </a>
                </li> -->
                <!--<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#banktransfer" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block"><i class="mdi mdi-bank-transfer-in"> </i> Bank Transfer</span>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#cheque" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-block"><i class="fas fa-money-check-alt"></i> Cheque</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <!-- uncomment to activate mpesa tab-->
                <!-- <div class="tab-pane active" id="mpesa" role="tabpanel">
                    <div class="form-group"> <input type="text" name="mpesanumber"
                            placeholder="Enter M-PESA Number to pay" class="form-control " required>
                    </div>
                    <div class="form-group">
                        <p> <button type="button" class="btn btn-primary "> Ksh. {{$Total_Payable ? number_format($Total_Payable, 2) : number_format(0,2)}} <i class="gr"></i> Pay <i
                                    class="mdi mdi-arrow-right mr-2"></i></button> </p>
                    </div>
                    <p class="mb-0">
                        <b>Dear Customer</b>
                        <br>
                        You will shortly receive an M-PESA prompt to enter your M-PESA pin to complete your
                        transaction. Please ensure your phone is on and unlocked to complete the process.
                        <br>
                        You can also pay using Lipa na Mpesa by using the below transactions.
                        <br>
                        1. Go to the M-PESA Menu.
                        <br>
                        2. Select LIPA NA MPESA
                        <br>
                        3. Select the Paybill Option
                        <br>
                        4. Enter Business Number <b>123456</b>
                        <br>
                        5. Enter the account number <b>*****</b>
                        <br>
                        6. Enter the amount <b>{{$Total_Payable ? number_format($Total_Payable, 2) : number_format(0,2)}}</b>
                        <br>
                        7. Enter your M-PESA pin and press OK to send.
                        <br>
                        8. You will receive a confirmation message from M-PESA and FKE with your reference.
                    </p>
                </div> -->
                <!-- End M-PESA Option -->

                <!-- Credit Card Option -->
                <div class="tab-pane active" id="creditcard" role="tabpanel">
                    <div class="form-group">
                        <label for="cardNumber">
                            <h6>Card number</h6>
                        </label>
                        <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number"
                                class="form-control " required>
                            <div class="input-group-append"> <span class="input-group-text text-muted"> <i
                                        class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i
                                        class="fab fa-cc-amex mx-1"></i> </span> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group"> <label><span class="hidden-xs">
                                        <h6>Expiration Date</h6>
                                    </span></label>
                                <div class="input-group"> <input type="number" placeholder="MM" name=""
                                        class="form-control" required> <input type="number" placeholder="YY" name=""
                                        class="form-control" required> </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4"> <label data-toggle="tooltip"
                                    title="Three digit CV code on the back of your card">
                                    <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                </label> <input type="text" required class="form-control"> </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment
                        </button>
                    </div>
                </div>
                <!-- End Credit Card Option -->



                <!-- Bank Transfer Option -->

                <div class="tab-pane" id="banktransfer" role="tabpanel">
                    <div class="form-group "> <label for="Select Your Bank">
                            <h6>Select your Bank</h6>
                        </label> <select class="form-control" id="ccmonth">
                            <option value="" selected disabled>--Please select your Bank--</option>
                            <option>Bank 1</option>
                            <option>Bank 2</option>
                            <option>Bank 3</option>
                            <option>Bank 4</option>
                            <option>Bank 5</option>
                            <option>Bank 6</option>
                            <option>Bank 7</option>
                            <option>Bank 8</option>
                            <option>Bank 9</option>
                            <option>Bank 10</option>
                        </select> </div>
                    <div class="form-group">
                        <p> <button type="button" class="btn btn-primary "><i class="mdi mdi-bank-transfer-in mr-2"></i>
                                Proceed To Payment</button> </p>
                    </div>
                </div>

                <!-- Cheque Payment Option -->
                <div class="tab-pane" id="cheque" role="tabpanel">
                    <p class="mb-0">
                        <b>Dear Customer</b>
                        <br>
                        For Cheque deposits, all cheques to be addressed to “Federation of Kenya Employers”
                        and have it delivered to our offices on
                        Waajiri House, Argwings Kodhek Road or banked to the account details below
                        <br><br>
                        <b>Bank:<b> NCBA Bank Kenya PLC
                                <br>
                                <b>Branch:</b> Prestige Branch
                                <br>
                                <b>Account Name:</b> Federation of Kenya Employers
                                <br>
                                <b>Account Number:</b> 1631590439
                    </p>
                </div>
                <!-- End Cheque Payment Option -->
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
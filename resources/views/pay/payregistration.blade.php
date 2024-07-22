@extends('layouts.master')

@section('title') Payments Gateway @endsection

@section('body')

<body>
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
    <div class="row">
        <div class="col-md-3 my-1">
            <div class="menu-card">
                <div class="contentCard">
                    <h3>Member Services</h3>
                </div>
                <div class="memberservices my-2 drops1">
                    <h4>Request for services online</h4>
                    <div class='menu-drops menu1'>
                        <p><a href="/newservice/" class="small-ident"><i class="las la-hand-point-right"></i> New
                                Request</a></p>
                        <p><a href="/myservices/" class="small-ident"><i class="las la-hand-point-right"></i> My
                                Services </a>
                        </p>
                    </div>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                <div class="memberservices my-2 drops2">
                    <h4 class="">Book appointment online </h4>
                    <div class='menu-drops menu2'>
                        <p><a href="/newappointments" class="small-ident"><i class="las la-hand-point-right"></i>
                                New Appointment
                            </a>
                        </p>
                        <p><a href="/Rescheduledappointments" class="small-ident"><i
                                    class="las la-hand-point-right"></i> Rescheduled
                                Appointment </a></p>
                        <p><a href="/allappointments" class="small-ident"><i class="las la-hand-point-right"></i> All
                                Appointments
                            </a>
                        </p>
                    </div>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                <div class="memberservices my-2 drops3">
                    <h4>Trainings</h4>
                    <div class='menu-drops menu3'>
                        <p><a href="/alltrainings/" class="small-ident"><i class="las la-hand-point-right"></i> All
                                Trainings </a>
                        </p>
                        <p><a href="/mytrainings/" class="small-ident"><i class="las la-hand-point-right"></i> My
                                Trainings </a>
                        </p>
                    </div>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                <div class="memberservices my-2 drops4">
                    <h4>Events</h4>
                    <div class='menu-drops menu4'>
                        <p><a href="/upcomingevents/" class="small-ident"><i class="las la-hand-point-right"></i>
                                All Events </a>
                        </p>
                        <p><a href="/myevents/" class="small-ident"><i class="las la-hand-point-right"></i> My
                                Events </a>
                        </p>
                    </div>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                <!-- <div class="memberservices my-2">
                        <p><a href="/cases" class="solo-menu"> Case
                                Management
                            </a>
                        </p>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div> -->
                <div class="memberservices my-2 drops5">
                    <h4>Financials</h4>
                    <div class='menu-drops menu5'>
                        <p><a href="/quotations" class="small-ident"><i class="las la-hand-point-right"></i>
                                Quotations</a>
                        </p>
                        <p><a href="/financials" class="small-ident"><i class="las la-hand-point-right"></i>
                                Invoices </a>
                        </p>
                        <p><a href="/receipts" class="small-ident"><i class="las la-hand-point-right"></i> Receipts
                            </a>
                        </p>
                        <p><a href="/getStatement/{{session('member_no')}}" target="_blank" class="small-ident"><i
                                    class="las la-hand-point-right"></i> Statement </a>
                        </p>

                    </div>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                <div class="memberservices my-2 drops6">
                    <h4>User
                        Management</h4>
                    <div class='menu-drops menu6'>
                        <p><a href="/users" class="small-ident"><i class="las la-hand-point-right"></i>
                                Users</a>
                        </p>
                        @if ($user['membertype'] == 'ASSOCIATION')
                        <p><a href="/associatedcompanies" class="small-ident"><i class="las la-hand-point-right"></i>
                                Associated Companies </a>
                        </p>
                        @endif
                    </div>
                </div>
                <div class="memberservices my-2">
                    <p><a href="/users" class="solo-menu">
                        </a>
                    </p>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                @if(session('isDocumentsAdmin') != null && session('isDocumentsAdmin') == true)
                <div class="memberservices my-2">
                    <p><a href="/documents-admin" class="solo-menu">
                            Documents Admin </a>
                    </p>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
                @endif
                <div class="memberservices my-2">
                    <p><a href="/contact" class="solo-menu"><i
                                class="bx bx-mail-send font-size-16 align-middle mr-1 text-danger"></i>
                            Contact </a>
                    </p>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>

                <div class="memberservices my-2">
                    <p><a href="/logout" class="solo-menu"><i
                                class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                            Logout </a>
                    </p>
                    <hr style="margin-top: -10px;border-top: 1px dotted red;">
                </div>
            </div>
        </div>
        <div class="col-md-4 my-1">
            <div class="summarycard">
                <h4 class="summarytitle">Total Pay</h4>
                <h2 class="summarycost">Ksh. {{number_format($data['Total_Payable'])}} </h2>
                <p class="summary-description">Choose from the payment options available to proceed. Your payment will
                    be processed immediately. </p>
                <div class="summaryalertcard">
                    <i class="fas fa-exclamation-circle" style="padding-top: 10px;
            padding-left: 10px; color: #FFFFFF;"></i>
                    <p class="summaryalert" style="padding:10px 20px 20px 10px; color: #FFFFFF;"> For Cheque and bank
                        transfer, kindly allow for verififcation before your account us updated.</p>
                </div>
                <div class="spacer-10"></div>
            </div>
        </div>
        <div class="col-md-5 my-1">
            <div class="paymentoptions">

                <div class="paymenttitle">
                    <p>Payment Details</p>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#claimpaymentb4login" id=claimpaymentb4login""
                            role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-credit-card"></i></span>
                            <span class="d-none d-sm-block"><i class="mdi mdi-credit-card"></i> Already Paid?</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#mpesa" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-phone"></i></span>
                            <span class="d-none d-sm-block"><i class=""><img src="{{ URL::asset('images/mpesa.png')}}"
                                        width="15%"></i> M-PESA</span>
                        </a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#creditcard" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-credit-card"></i></span>
                            <span class="d-none d-sm-block"><i class="mdi mdi-credit-card"></i> Credit Card</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#banktransfer" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-bank-transfer-in"></i></span>
                            <span class="d-none d-sm-block"><i class="mdi mdi-bank-transfer-in"> </i> Bank
                                Transfer</span>
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cheque" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-money-check-alt"></i></span>
                            <span class="d-none d-sm-block"><i class="fas fa-money-check-alt"></i> Cheque</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="mpesa" role="tabpanel">
                        <div class="form-group"> <input type="text" name="mpesanumber"
                                placeholder="Enter M-PESA Number to pay" class="form-control " required>
                        </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary "> Ksh.
                                    {{number_format($data['Total_Payable'])}} <i class="gr"></i> Pay <i
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
                            5. Enter the account number <b>{{$data['No']}}</b>
                            <br>
                            6. Enter the amount
                            <b>{{$data['Total_Payable'] ? number_format($data['Total_Payable'], 2) : number_format(0,2)}}.</b>
                            <br>
                            7. Enter your M-PESA pin and press OK to send.
                            <br>
                            8. You will receive a confirmation message from M-PESA and FKE with your reference.
                        </p>
                    </div>
                    <!-- End M-PESA Option -->

                    <!-- Credit Card Option -->
                    <div class="tab-pane" id="creditcard" role="tabpanel">
                        <div class="form-group">
                            <label for="cardNumber">
                                <h6>Card number</h6>
                            </label>
                            <div class="input-group"> <input type="text" name="cardNumber"
                                    placeholder="Valid card number" class="form-control " required>
                                <div class="input-group-append"> <span class="input-group-text text-muted"> <i
                                            class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i>
                                        <i class="fab fa-cc-amex mx-1"></i> </span> </div>
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
                    <!-- Begin Claim Payment Option -->
                    <div class="tab-pane" id="claimpaymentb4login" role="tabpanel">
                        <form method="POST" enctype="multipart/form-data" id="claimpaymentb4login"
                            action="{{ action('FinancialsController@claimPaymentB4Login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="cardNumber">
                                    <h6>Transaction Reference Number</h6>
                                </label>
                                <div class="input-group"> <input type="text" name="refno" class="form-control "
                                        required>
                                    <div class="input-group-append"> <span class="input-group-text text-muted"> <i
                                                class="fab fa-cc-visa mx-1"></i> <i
                                                class="fab fa-cc-mastercard mx-1"></i>
                                            <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="RegNo">
                                    <h6>Company Registration No</h6>
                                </label>
                                <div class="input-group"> <input type="text" name="compreg" class="form-control "
                                        required>
                                    <div class="input-group-append"> <span class="input-group-text text-muted"> <i
                                                class="fab fa-cc-visa mx-1"></i> <i
                                                class="fab fa-cc-mastercard mx-1"></i>
                                            <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" id="claimpaymentb4login"
                                    class="btn btn-primary btn-block shadow-sm"> Confirm Payment
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- End Credit Card Option -->



                    <!-- Bank Transfer Option -->

                    <div class="tab-pane" id="banktransfer" role="tabpanel">
                        <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>NCBA</option>

                            </select> </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary "><i
                                        class="mdi mdi-bank-transfer-in mr-2"></i> Proceed To Payment</button> </p>
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
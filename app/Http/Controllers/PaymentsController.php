<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser')->only('paymentGateway');
    }
    public function paymentGateway($Total_Payable = null)
    {
        return view('/pay/paymentgateway')->with('Total_Payable', $Total_Payable);
    }

    public function paymentRegistration()
    {
        return view('/pay/payRegistration');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;
use App\Models\MemberCharges;
use App\Models\CustLedgerEntries;

class FinancialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function getFinancials()
    {
        $AllLedgerEntries = getfilteredNavData('Cust_LedgerEntries', 'Customer_No', session('member_no'))['value'];
        $MyLedgerEntries = array_filter($AllLedgerEntries, function ($var) {
            return ($var['Reversed'] == false);
        });

        $billsdue = array_filter($MyLedgerEntries, function ($var) {
            return ($var['Due_Date'] <= date('Y-m-d') and $var['Open'] == true and $var['Document_Type'] == 'Invoice');
        });

        $totalbillsdue = array_sum(array_column($billsdue,'Amount'));
        $myinvoices = getfilteredNavData('PostedCharges', 'Customer_No', session('member_no'))['value'];
        $receipts = getfilteredNavData('PostedReceipts', 'Account_No', session('member_no'))['value'];
        $totalreceipts = array_sum(array_column($receipts,'Amount'));
        $MyProfile = getfilteredNavData('Customers', 'No', session('member_no'))['value'];

        $OutstandingBalance = $totalbillsdue - $totalreceipts;

        foreach ($MyProfile as $value) {
        }
        if ($value) {
            $MyProfile = $MyProfile[0];
        }

        return view('/financials/financials')->with('invoicedata', $myinvoices)
                                             ->with('MyProfile', $MyProfile)
                                             ->with('totalbillsdue', $totalbillsdue)
                                             ->with('totalreceipts', $totalreceipts)
                                             ->with('OutstandingBalance', $OutstandingBalance);
    }

    public function getQuotations()
    {
        $AllLedgerEntries = getfilteredNavData('Cust_LedgerEntries', 'Customer_No', session('member_no'))['value'];
        $MyLedgerEntries = array_filter($AllLedgerEntries, function ($var) {
            return ($var['Reversed'] == false);
        });

        $billsdue = array_filter($MyLedgerEntries, function ($var) {
            return ($var['Due_Date'] <= date('Y-m-d') and $var['Open'] == true and $var['Document_Type'] == 'Invoice');
        });

        $totalbillsdue = array_sum(array_column($billsdue,'Amount'));
        $myquotations = getfilteredNavData('ProfomaInvoices', 'Customer_No', session('member_no'))['value'];
        $receipts = getfilteredNavData('PostedReceipts', 'Account_No', session('member_no'))['value'];
        $totalreceipts = array_sum(array_column($receipts,'Amount'));
        $MyProfile = getfilteredNavData('Customers', 'No', session('member_no'))['value'];

        $OutstandingBalance = $totalbillsdue - $totalreceipts;

        foreach ($MyProfile as $value) {
        }
        if ($value) {
            $MyProfile = $MyProfile[0];
        }

        return view('/financials/quotations')->with('invoicedata', $myquotations)
                                             ->with('MyProfile', $MyProfile)
                                             ->with('totalbillsdue', $totalbillsdue)
                                             ->with('totalreceipts', $totalreceipts)
                                             ->with('OutstandingBalance', $OutstandingBalance);
    }

    public function receipts(){
        if(session('member_no') == ''){
            return redirect('/');
        }else{
            $receipts = getfilteredNavData('PostedReceipts', 'Account_No', session('member_no'))['value'];
            return view('/financials/receipts')->with('receipts', $receipts);
        }
    }

    public function statement(){
        if(session('member_no') == ''){
            return redirect('/');
        }else{
            return view('/financials/statement');
        }
    }

    public function getStatement($custno){
        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }

            $params->custno = $custno;
            $params->filenamefromapp = $custno.".pdf";
            $result = $service->FnGenerateStatement($params);
            return response()->file("C:\\Portal Downloads\\".$custno.".pdf");
        }catch (Exception $e){
            return redirect ('/financials')->with('error', $e->getMessage());
        }
    }

    public function downloadinvoice($invno){
        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }

            $custno = session('member_no');

            $params->membno = $custno;
            $params->docno = $invno;
            $params->filenamefromapp = $invno.".pdf";
            $result = $service->FnGenerateInvoice($params);
            return response()->file("C:\\Portal Downloads\\".$invno.".pdf");
        }catch (Exception $e){
            return redirect ('/financials')->with('error', $e->getMessage());
        }
    }
    public function downloadreceipt($rcptno){
        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }

            $params->receiptno = $rcptno;
            $params->filenamefromapp = $rcptno.".pdf";
            $result = $service->FnGenerateReceipt($params);
            return response()->file("C:\\Portal Downloads\\".$rcptno.".pdf");
        }catch (Exception $e){
            return redirect ('/financials')->with('error', $e->getMessage());
        }
    }
    public function claimPayment(REQUEST $request){
        $this->validate($request, [
            'refno' => 'required',
        ]);

        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }
            $params->receiptno = session('member_no');
            $params->transCode = $request->refno;
            $params->custNo = session('member_no');
            
            $result = $service->FnClaimPayment($params);
            //dd($result);
            foreach($result as $retvalue){}

            if($retvalue){
                return redirect ('/receipts')->with('success', 'Receipt Successfully Claimed');
            }else{
                return redirect ('/receipts')->with('error','Something went Wrong'); 
            }
        }catch (Exception $e){
            return redirect ('/receipts')->with('error', $e->getMessage());
        }
    }
    public function claimPaymentB4Login(REQUEST $request){
        $this->validate($request, [
            'refno' => 'required',
            'compreg' => 'required'            
        ]);
        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }
            $params->transCode = $request->refno;
            $params->compReg = $request->compreg;
            $result = $service->claimPaymentB4Login($params);

            foreach($result as $retvalue){}
            if($retvalue){
                return redirect ('/')->with('success', 'Receipt Successfully Claimed. Kindly wait as your application is being reviewed and approved');
            }else{
                return redirect ('/')->with('error','Something went Wrong'); 
            }
        }catch (Exception $e){
            return redirect ('/')->with('error', $e->getMessage());
        }
    }
}
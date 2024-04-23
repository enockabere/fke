<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;
use App\Models\Events\EventRegistration;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class CasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function getMyCases()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else{
            try {           
                $MyCases = getfilteredNavData('MyCases', 'Member_No', session('member_no'));             
    
                if ($MyCases) {                
                    $data = $MyCases['value'];
                    if (session('association_code') !== '') {
                        $data = array_filter($data, function($var) {
                            return ($var['Association_Code'] == session('association_code'));
                        });
                    }
                }
    
                return view('/cases/cases')->with('data', $data);
            } catch (Exception $e) {
                    return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }        
    }

    public function Casedetails($no)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else{
            $CaseDetails = getfilteredNavData('MyCaseActivities', 'No', $no)['value'];

            return view('/cases/caseactivities')->with('data', $CaseDetails);
        }
    }
}
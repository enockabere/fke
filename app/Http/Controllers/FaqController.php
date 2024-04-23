<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function getFaqs()
    {
        if (session('member_no') == '' or session('member_no') == null)
        {
            redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try{
                $faqs = getNavData('Faqs')['value'];
                
                //dd($faqs);

                $General = array_filter($faqs, function ($var) {
                    return ($var['FAQ_Category'] == 'General');
                });

                $Billing = array_filter($faqs, function ($var) {
                    return ($var['FAQ_Category'] == 'Billing');
                });

                $Support = array_filter($faqs, function ($var) {
                    return ($var['FAQ_Category'] == 'Support');
                });

                return view('/faqs/faqs')->with('General',$General)
                                         ->with('Billing',$Billing)
                                         ->with('Support',$Support);
            } catch(Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }
}
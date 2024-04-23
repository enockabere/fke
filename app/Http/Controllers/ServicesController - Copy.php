<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use App\Models\Events\Services as EventsServices;
use Exception;
use Storage;
use App\Models\Services\Services;
use SebastianBergmann\Environment\Console;

class ServicesController extends Controller
{
    public function upload(Request $request){
        $files = $request->file('file');
        $updateno = $request->ServiceCode;

        if(!empty($files)):

            foreach($files as $file):
                Storage:: put($file->getClientOriginalName(), file_get_contents($file));

                $binary_file = base64_encode(file_get_contents($file));
                $filename = $file->getClientOriginalName();
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }
                $params->docNo = $updateno;
                $params->fileName = $filename;
                $params->attachment = $binary_file;
                $params->tableID = 50024;
                $result=$service->UploadAttachedDocument($params);
            endforeach;
            
        endif;
        return redirect('/newservice')->with('success', 'The Attachments were successfully submitted!');
        //return \Response::json(array('success'=>true));
    }
    
    public function getservices($status = 'all')
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                if ($status == 'all') {
                    $MyServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'));
                    $data = $MyServices['value'];
                } else if ($status == 'active') {
                    $MyServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'))['value'];
                    $data = array_filter($MyServices, function ($var) {
                        return ($var['Status'] == 'Pending' || $var['Status'] == 'Active');
                    });
                }

                return view('/services/myservices')->with('data', $data);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function requestService()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MyServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'))['value'];

                $LastRequest = end($MyServices);

                if ($LastRequest) {
                    return redirect('/servicedetails/'.$LastRequest['No']);
                } else {
                    return redirect('/servicedetails/');
                }
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function serviceDetails($no = '')
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $Services= getNavData('Services')['value'];
                $Services = array_filter($Services, function ($var) {
                    return ($var['Service_Code'] !== '');
                });
                $PaymentMethods = getNavData('PaymentMethods')['value'];
                $MyServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'))['value'];
                $ServiceLines = getfilteredNavData('ServiceLines', 'No', $no)['value'];

                foreach ($ServiceLines as $key => $request) {
                    //Get the blob description
                    $service = new NTLMSoapClient(config('app.webService'));
                    if (!isset($params)) {
                        $params = new \stdClass();
                    }

                    $params->tableID = 50025;
                    $params->entryNo = $request['Entry_No'];
                    $params->description = '';
                    $result = $service->FnGetIntKeyBLOBString($params);

                    $ServiceLines[$key]["response"] = $result->description;
                }

                //Sort descending:
                rsort($MyServices);

                return view('/services/newservice')->with('MyServices', $MyServices)
                                                   ->with('ServiceLines', $ServiceLines)
                                                   ->with('PaymentMethods', $PaymentMethods)
                                                   ->with('Services', $Services)
                                                   ->with('LastNo', $no);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function serviceLines($no)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $ServiceLines = getfilteredNavData('ServiceLines', 'No', $no)['value'];

                foreach ($ServiceLines as $key => $request) {
                    //Get the blob description
                    $service = new NTLMSoapClient(config('app.webService'));
                    if (!isset($params)) {
                        $params = new \stdClass();
                    }

                    $params->tableID = 50025;
                    $params->entryNo = $request['Entry_No'];
                    $params->description = '';
                    $result = $service->FnGetIntKeyBLOBString($params);

                    $ServiceLines[$key]["response"] = $result->description;
                    $ServiceLines[$key]["service_date"] = date_format(date_create($request['Response_Date']), "d M");
                }
                //dd($ServiceLines);
                echo json_encode(['ServiceLines' => $ServiceLines]);
            }catch(Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function newInquiry(REQUEST $request)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $this->validate($request, [
                    'service' => 'required',
                    'sms' => 'required',
                    //'paymethod' => 'required'
                ]);

                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->custno = session('member_no');
                $params->service = $request->service;
                $params->servicevalue = $request->servicevalue;
                $params->sms = $request->sms;
                $params->paymethod = $request->paymethod;              
                $params->nextno = '';
                $result = $service->FnNewInquiry($params);
                
                return redirect('/newservice')->with('success', 'The Service Request was successfully submitted!');

            }catch(Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function inquire(REQUEST $request)
    {
        $this->validate($request, [
            'inquiry' => 'required'
        ]);

        $service = new NTLMSoapClient(config('app.webService'));

        if (!isset($params)) {
            $params = new \stdClass();
        }

        $params->code = $request->code;
        $params->sms = $request->inquiry;
        $result = $service->FnSubmitInquiry($params);

        $MyServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'))['value'];
        $ServiceLines = getfilteredNavData('ServiceLines', 'No', $request->code)['value'];

        foreach ($ServiceLines as $key => $request) {
            //Get the blob description
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }

            $params->tableID = 50025;
            $params->entryNo = $request['Entry_No'];
            $params->description = '';
            $result = $service->FnGetIntKeyBLOBString($params);

            $ServiceLines[$key]["response"] = $result->description;
        }

        //Sort descending:
        rsort($MyServices);

        return redirect('/servicedetails/'. $params->code);
        
    }
}
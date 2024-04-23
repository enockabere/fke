<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;
use Storage;

class TrainingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function getOfferedTrainings()
    {
        if(session('member_no') == '' or session('member_no') == null){
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        }else{
            try{
                $offeredtrainings = getfilteredNavData('OfferedTrainings', 'Active', 'Yes');
                //dd($offeredtrainings);
                $data = $offeredtrainings['value'];

                return view('/trainings/alltrainings')->with('data', $data);
            } catch(Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function viewTraining($no)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try{
                $Training = getfilteredNavData('OfferedTrainings', 'No', $no)['value'];
                foreach ($Training as $value) {
                }
                if ($value) {
                    $Training = $Training[0];
                }

                $Modules = getfilteredNavData('TrainingModules', 'No', $no)['value'];
                $Dates = getfilteredNavData('TrainingDates', 'No', $no)['value'];
                $Facilitators = getfilteredNavData('TrainingFacilitators', 'No', $no)['value'];
                $Participants = getfilteredNavData('TrainingParticipants', 'No', $no)['value'];

                foreach($Facilitators as $key => $facilitator ) {
                    $Facilitators[$key]["image"] = $this->getimage($facilitator['Entry_No']);
               }

               //Get the blob description
               $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }


                $params->tableID = 50110;
                $params->docNo = $Training['No'];
                $params->moreInfo = '';
                $result = $service->FnGetBLOBString($params);

                $Training['Description'] = $result->moreInfo;

                return view('/trainings/viewtraining')->with('Training', $Training)
                                                      ->with('Modules',$Modules)
                                                      ->with('Dates',$Dates)
                                                      ->with('Facilitators',$Facilitators)
                                                      ->with('Participants',$Participants);
            } catch(Exception $e) {
                return redirect('/alltrainings')->with('error', $e->getMessage());
            }
        }

    }

    public function getimage($entryno)
    {
        $attachment = '';
        $contentType = '';
        $fileName = '';

        $service = new NTLMSoapClient(config('app.webService'));
        if (!isset($params)) {
            $params = new \stdClass();
        }

        $params->accountNo = $entryno;
        $params->attachment = $attachment;
        $params->contentType = $contentType;
        $params->fileName = $fileName;
        $result = $service->FnGetFacilitators($params);
        $data = base64_decode($result->attachment);
        $content = $result->contentType;

        $type = substr($content, 0, strpos($content, '/'));

        if ($type == 'image') {
            return ('"data:' . $content . ';base64,' . $result->attachment . '"');
        }
    }

    public function registertraining(REQUEST $request)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $regno  = 0;
                $regno = $request->regno;

               //--------Import Excel:
                if ($request->hasFile('trainingattendeeslist')) {
                    session(['trainingattendeeslist' => '']);
                    session()->save();
                    $row = 1;
                    $trainingattendeeslist_array = array();
                    
                    if (($handle = fopen($request->file('trainingattendeeslist'), "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
                            if(empty($data)) continue;
                            $row ++;                              
                            if($row > 2){
                                $trainingattendeeslist_array []= $data;
                            }
                        }
                    }                    

                    session(['trainingattendeeslist' => $trainingattendeeslist_array]);
                    session()->save();

                    foreach(session('trainingattendeeslist') as $a){
                        $service = new NTLMSoapClient(config("app.webService"));
                        if(!isset($params)){
                            $params = new \stdClass();
                        }
                        $params->custno = session('member_no');
                        $params->regno = $request->regno;
                        $params->name = $a[0];
                        $params->email_address = $a[1];
                        $params->phone_no = $a[2];
                        $params->totPayable = 0;
                        $params->postal_address = $a[3];
                        $params->kra_Pin = $a[4];
                        $result2 = $service->FnTrainingRegistrationLines($params);
                     }
                    }
                    if ($value) {
                        return redirect("/mytrainingdetails/{$regno}")->with('success', 'You have Successfully Registered for the Training');
                    } else {
                        return redirect("/mytrainingdetails/{$regno}")->with('error', 'Could not save your registration. Kindly retry');
                    }

            } catch (Exception $e) {
                return redirect('/alltrainings')->with('error', $e->getMessage());
            }
        }
    }
    public function addAttendee(REQUEST $request)
    {                
        $this->validate($request, [
            'Att_Name' => 'required',
            'Att_Email' => 'required|email',
            'Att_phone'=> 'required|numeric',
            'Post_Address' => 'required',
            'KRA_PIN' => 'required',
            
        ]);
        
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $service = new NTLMSoapClient(config("app.webService"));
                if(!isset($params)){
                    $params = new \stdClass();
                }
                
                $params->custno = session('member_no');
                $params->regno = $request->regno;
                $params->name = $request->Att_Name;
                $params->email_address = $request->Att_Email;
                $params->phone_no = $request->Att_phone;
                $params->totPayable = 0;
                $params->postal_address = $request->Post_Address;
                $params->kra_Pin = $request->KRA_PIN;
                $result2 = $service->FnTrainingRegistrationLines($params);

                if ($result2->return_value === true) {
                    return redirect("/mytrainingdetails/{$request->regno}")->with('success', 'You have Successfully Registered for the Training');
                } else {
                    return redirect("/mytrainingdetails/{$request->regno}")->with('error', 'Could not save your registration. Kindly retry');
                }

            } catch (Exception $e) {
                return redirect("/mytrainingdetails/{$request->regno}")->with('error', $e->getMessage());
            }
        }
    }

    public function GetAttendeeInvoice(REQUEST $request)
    {                       
        try {
            $service = new NTLMSoapClient(config("app.webService"));
            if(!isset($params)){
                $params = new \stdClass();
            }
            $params->docNo = $request->regno;
            $result2 = $service->FnInvoiceTraining($params);

            if ($result2->return_value === true) {
                $Total_Payable = $request->total_payable;                
                return redirect('/paymentgateway'.'/'.$Total_Payable)->with('success', 'You have Successfully Registered for the Training');
            } else {
                return redirect("/mytrainingdetails/{$request->regno}")->with('error', 'Could not save your registration. Kindly retry');
            }

        } catch (Exception $e) {
            return redirect("/mytrainingdetails/{$request->regno}")->with('error', $e->getMessage());
        }
    }

    public function UploadAttachedDocument(Request $request){
        $file = $request->file('file');
        $regno = $request->regno;
        
        if(!empty($file)) {
            Storage::put($file->getClientOriginalName(), file_get_contents($file));
            
            $binary_file = base64_encode(file_get_contents($file));
            $filename = $file->getClientOriginalName();
            $service = new NTLMSoapClient(config('app.webService'));
            
            if (!isset($params)) {
                $params = new \stdClass();
            }
            
            $params->docNo = $regno;
            $params->fileName = $filename;
            $params->attachment = $binary_file;
            $params->tableID = 50116;
            
            $result = $service->UploadAttachedDocument($params);
            
            return redirect("/mytrainingdetails/{$request->regno}")->with('success', 'The Attachment was successfully submitted!');
        } else {
            return redirect("/mytrainingdetails/{$request->regno}")->with('error', 'No attachment provided.');
        }
    }
    

    public function RegisterNewTraining(REQUEST $request)
    {                       
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $trainingtype  = 0;
                $trainingno = $request->trainingno;
                $trainingtype = $request->trainingtype;

                if ($trainingtype == 'Scheduled') {
                    $trainingtype = 1;
                } else if($trainingtype == 'Requested') {
                    $trainingtype = 2;
                }

                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->trainingno = $trainingno;
                $params->trainingtype = $trainingtype;
                $params->regno = '';
                $params->custno = session('member_no');
                $result = $service->FnTrainingRegistration($params);

                if ($result->return_value === true) {
                    return redirect("/mytrainingdetails/{$result->regno}");
                }                
                else {
                     return redirect('/mytrainings')->with('error', 'Could not save your registration. Kindly retry');
                }
            } catch (Exception $e) {
                return redirect("/mytrainingdetails/{$result->regno}")->with('error', $e->getMessage());
            }
        }
    }


    public function getMyTrainings()
    {
        if(session('member_no') == '' or session('member_no') == null){
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        }else{
            try{
                $memberno = session('member_no');
                $MyTrainings = getfilteredNavData('MyTrainings', 'Account_No', $memberno);

                $data = $MyTrainings['value'];
                return view('/trainings/mytrainings')->with('data', $data);

            } catch(Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function myTrainingDetails($no)
    {
        $MyTrainings = getfilteredNavData('MyTrainings', 'No', $no)['value'];
        foreach ($MyTrainings as $value) {
        }
        if ($value) {
            $MyTrainings = $MyTrainings[0];
        }

        $Attendees = getfilteredNavData('TrainingAttendees', 'No', $no)['value'];

        //Get the blob description
        $service = new NTLMSoapClient(config('app.webService'));
        if (!isset($params)) {
            $params = new \stdClass();
        }

        $params->tableID = 50110;
        $params->docNo = $MyTrainings['Training_No'];
        $params->moreInfo = '';
        $result = $service->FnGetBLOBString($params);
        $MyTrainings['Description'] = $result->moreInfo;
        $lpo_attachments = getfilteredNavData('QyAttachments', 'No', $no)['value'];

        return view('/trainings/mytrainingdetails')->with('MyTrainings', $MyTrainings)
                                                   ->with('lpo_attachments', $lpo_attachments)
                                                   ->with('lpo_attachments', $lpo_attachments)
                                                   ->with('Attendees', $Attendees);
    }
}
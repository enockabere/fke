<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;
use App\Models\Events\EventRegistration;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function getUpcomingEvents()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            $upcomingevents = getNavData('UpcomingEvents');
            //$upcomingevents = getfilteredNavData('UpcomingEvents','Archived',false);

            $data = $upcomingevents['value'];
            return view('/events/upcomingevents')->with('data', $data);
        }
    }

    public function viewevent($event)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $data = getfilteredNavData('UpcomingEvents', 'Event_No', $event)['value'];

                foreach ($data as $value) {
                }
                if ($value) {
                    $data = $data[0];
                }

                return view('/events/eventdetails')->with('data', $data);
            } catch (Exception $e) {
                return redirect('/myevents')->with('error', $e->getMessage());
            }
        }
    }

    public function registerevent(REQUEST $request)
    {
        $Payment = $request->input('Payment');
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $eventno = $request->event;
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->eventno = $eventno;
                $params->regno = '';
                $params->custno = session('member_no');
                $result = $service->RegisterEvent($params);

                //--------Import Excel:
                if ($request->hasFile('attendeeslist')) {
                    session(['attendeeslist' => '']);
                    session()->save();
                    $row = 1;
                    $attendeeslist_array = array();
                    if (($handle = fopen($request->file('attendeeslist'), "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
                            $row ++;
                            if($row > 2){
                                $attendeeslist_array []= $data;

                            }
                        }
                    }
                        session(['attendeeslist' => $attendeeslist_array]);
                        session()->save();

                    foreach(session('attendeeslist') as $a){
                        $service = new NTLMSoapClient(config("app.webService"));
                        if(!isset($params)){
                            $params = new \stdClass();
                        }
                        $params->custno = session('member_no');
                        $params->regno = $result->regno;
                        $params->name = $a[0];
                        $params->email_address = $a[1];
                        $params->phone_no = $a[2];
                        $result2 = $service->RegisterEventLines($params);
                     }
                    }
                //--------End Import Excel:


                foreach ($result as $value) {
                }
                if ($value and $Payment=="0") {
                    return redirect('/paymentgateway')->with('success', 'You have Successfully Registered for the Training');
                }elseif($value and $Payment=="1"){
                    return redirect('/upcomingevents')->with('success', 'You have Successfully Registered for the Training');
                } else {
                    return redirect('/myevents')->with('error', 'Could not save your registration. Kindly retry');
                }

            } catch (Exception $e) {
                return redirect('/upcomingevents')->with('error', $e->getMessage());
            }
        }
    }
    public function addevent(REQUEST $request)
    {
        $this->validate($request, [
            'Att_Name' => 'required',
            'Att_Email' => 'required|email',
            'Att_phone'=> 'required|numeric',
        ]);
        $Payment = $request->input('Payment');
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            
            try {
                $eventno = $request->event;

                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->eventno = $eventno;
                $params->regno = '';
                $params->custno = session('member_no');
                $result = $service->RegisterEvent($params);

                //--------Import Excel:
                $service = new NTLMSoapClient(config("app.webService"));
                if(!isset($params)){
                    $params = new \stdClass();
                }
                $params->custno = session('member_no');
                $params->regno = $result->regno;
                $params->name = $request->Att_Name;
                $params->email_address = $request->Att_Email;
                $params->phone_no = $request->Att_phone;
                $result2 = $service->RegisterEventLines($params);
                //--------End Import Excel:
                foreach ($result as $value) {
                }
                if ($value and $Payment=="0") {
                    return redirect('/paymentgateway')->with('success', 'You have Successfully Registered for the Training');
                }elseif($value and $Payment=="1"){
                    return redirect('/upcomingevents')->with('success', 'You have Successfully Registered for the Training');
                } else {
                    return redirect('/upcomingevents')->with('error', 'Could not save your registration. Kindly retry');
                }

            } catch (Exception $e) {
                return redirect('/upcomingevents')->with('error', $e->getMessage());
            }
        }
    }

    public function myevents()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $memberno = session('member_no');
                $myevents = getfilteredNavData('MyEvents', 'Account_No', $memberno);

                $data = $myevents['value'];
                return view('/events/myevents')->with('data', $data);
            } catch (Exception $e) {
                return redirect('/myevents')->with('error', $e->getMessage());
            }
        }
    }

    public function myeventdetails($no)
    {
        $event = EventRegistration::where('No', '=', $no)->with('Attendees')->first();
        $eventdetails = getfilteredNavData('UpcomingEvents', 'Event_No', $event['Event No'])['value'];

        foreach ($eventdetails as $value){            
        }
        if ($value) {
            $eventdetails = $eventdetails[0];
        }

        return view('/events/myeventdetails')->with('data', $event)
                                             ->with('eventdetails', $eventdetails);
    }
}
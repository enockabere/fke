<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;
use NTLMStream;

class AppointmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function getNew()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $Services = getNavData('Services')['value'];
                //dd($Services);

                return view('/appointments/newappointments')->with('Services', $Services);

            } catch(Exception $e)
            {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function createAppointment(REQUEST $request)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else 
        try{
            $this->validate($request, [
                'appdate' => 'required',
                'apptime' => 'required',
                'duration'=> 'required',
                'type'    => 'required',
                'remarks' => 'required'
            ]);

            $service = new NTLMSoapClient(config('app.webService'));

            if(!isset($param)) {
                $params = new \stdClass();
            }
            
            $MembNo = session('member_no');

            $request->appdate = date("Y-m-d", strtotime($request->appdate));

            $params->custno = $MembNo;
            $params->type = $request->type;
            $params->appdate = $request->appdate;
            $params->apptime = $request->apptime;
            $params->duration = $request->duration;
            $params->remarks = $request->remarks;
            $params->dispatchTo = $request->dispatchto;
            $params->nextno ='';
            $result = $service->FnCreateAppointment($params);
            //dd($result);

            if ($result->return_value) {
                return redirect('/allappointments')->with('success', 'Appointment Request successfully raised!');
            }
        } catch (Exception $e) {
            return redirect('/allappointments')->with('error', $e->getMessage());
        }
    }

    public function getAppointments()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $Events = [];
                $MyAppointments = getfilteredNavData('MyAppointments','Member_No',$MembNo)['value'];

                foreach($MyAppointments as $appointment) {
                    if($appointment['Status'] == 'Approved' || $appointment['Status'] == 'Completed') {
                        $Events[] = [
                            'title' => $appointment['Remarks'],
                            'start' => $appointment['Appointment_Date'],
                            'end' => '',
                            'allDay' => false,
                        ];
                    }
                };

                $myevents = getfilteredNavData('MyEvents', 'Account_No', $MembNo)['value'];


                foreach($myevents as $myevent) {
                    $Events[] = [
                        'title' => $myevent['Event_Description'],
                        'start' => $myevent['Event_Start_Date'],
                        'end' => $myevent['Event_End_Date'],
                        'allDay' => false,
                        'color' => '#cc0000',
                        'url' => '/myeventdetails/'.$myevent['No']
                    ];
                };

                return view('/appointments/allappointments')->with('MyAppointments', $MyAppointments)
                                                            ->with('Events', $Events);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function Rescheduled()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $Events = [];
                $MyAppointments = getfilteredNavData('MyAppointments','Member_No',$MembNo)['value'];

                if ($MyAppointments) {
                    $MyAppointments = array_filter($MyAppointments, function ($var) {
                        return ($var['Rescheduled'] == true);
                    });

                    /*
                    foreach($MyAppointments as $key=>$appointment){
                        $MyAppointments[$key]['suggested_date'] = end(getfilteredNavData('RescheduledAppointments', 'No', $appointment['Appointment_No'])['value'])['Suggested_Date'];
                        $MyAppointments[$key]['suggested_time'] = end(getfilteredNavData('RescheduledAppointments', 'No', $appointment['Appointment_No'])['value'])['Suggested_Time'];
                    }
                    */
                }

                $myevents = getfilteredNavData('MyEvents', 'Account_No', $MembNo)['value'];
                foreach($myevents as $myevent) {
                    $Events[] = [
                        'title' => $myevent['Event_Description'],
                        'start' => $myevent['Event_Start_Date'],
                        'end' => $myevent['Event_End_Date'],
                        'allDay' => false,
                        'color' => '#cc0000',
                        'url' => '/myeventdetails/'.$myevent['No']
                    ];
                };

                return view('/appointments/rescheduledappointments')->with('MyAppointments', $MyAppointments)
                                                            ->with('Events', $Events);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function viewappointment($no)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MyDetails = getfilteredNavData('MyAppointments','Appointment_No',$no)['value'];
                echo json_encode(['MyDetails' => $MyDetails]);
            }catch(Exception $e) {
                return redirect('/getAppointments')->with('error', $e->getMessage());
            }
        }
    }

    public function confirmappointment($no, $date)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->appno = $no;
                $params->appdate = $date;
                $result = $service->FnConfirmAppointment($params);
                foreach ($result as $value) {
                }

                if ($value) {
                    return redirect('/allappointments')->with('success', 'The request has been submitted and is awaiting Approval!');
                } else {
                    return redirect('error', 'Could not save info');
                }

            }catch(Exception $e) {
                return redirect('/allappointments')->with('error', $e->getMessage());
            }
        }
    }

    public function cancelappointment($no, $date)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->appno = $no;
                $params->appdate = $date;
                $result = $service->FnCancelAppointment($params);
                foreach ($result as $value) {
                }

                if ($value) {
                    return redirect('/allappointments')->with('success', 'The Apointment was Successfully Canceled!');
                } else {
                    return redirect('error', 'Could not Cancel Request. Please try again!');
                }

            }catch(Exception $e) {
                return redirect('/allappointments')->with('error', $e->getMessage());
            }
        }
    }

}
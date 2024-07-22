<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use App\Models\Prospects;
use App\Models\Contacts;
use App\Models\Customer;
use App\Models\MemberCategories;
use App\Models\Employees;
use App\Models\DimensionValues;
use App\Models\Industries;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\resetMail;
use Auth;
use DateTime;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser')->only('dashboard');
        $this->middleware('validateBalance')->only('dashboard');
    }
    public function index()
    {
        return view('home');
    }

    public function register()
    {
        $MemberTypes = getNavData('MemberTypes')['value'];
        //dd($MemberTypes);
        foreach ($MemberTypes as $value) {
        }
        if ($value) {
            $MemberTypes = $MemberTypes;
        }
        
        return view('/registration/register')->with('MemberTypes', $MemberTypes);
    }

    public function registerstep2($regno)
    {
        session(['regno' => $regno]);

        if ($regno == '' or $regno == null) {
            return redirect('/register')->with('error', 'CompanyReg not found');
        } else {
            return view('/registration/register_step2')->with('regno', $regno);
        }
    }

    public function prospcategories($regno)
    {
        $prospect = Prospects::where('Incorporation No', '=', strtoupper($regno))->first();
        $MemberType = $prospect['Member Type'];
        if($MemberType !== '') {  
            $query = MemberCategories::where('Member Type','=', $MemberType)->get();
        } else {            
            $query = MemberCategories::get();
        }
        echo "<option value='' selected>--Select--</option>\n";
        foreach ($query as $row) {
            $value = $row['Code'];
            $text = $row['Description'];
            echo "<option value='$value'>$text</option>";
        }
    }
    public function memcategories($regno)
    {
        $prospect = Customer::where('No_', '=', $regno)->first();
        $MemberType = $prospect['Member Type'];
        if($MemberType !== '') {  
            $query = MemberCategories::where('Member Type','=', $MemberType)->get();
        } else {            
            $query = MemberCategories::get();
        }
        echo "<option value='' selected>--Select--</option>\n";
        foreach ($query as $row) {
            $value = $row['Code'];
            $text = $row['Description'];
            echo "<option value='$value'>$text</option>";
        }
    }
    public function branches()
    {
        $query = DimensionValues::where('Dimension Code', '=', 'BRANCHES')->get();
        echo "<option value='' selected>--Select--</option>\n";
        foreach ($query as $row) {
            $value = $row['Code'];
            $text = $row['Name'];
            echo "<option value='$value'>$text</option>";
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function login(REQUEST $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;
        $accountType = 1;

        $today = date("l, d F Y"); //H:i:s

        $user = Customer::where('E-Mail', '=', $email)->first();

        if ($user == '' or $user == null) {
            $accountType = 2;
            $user = Contacts::where('E-Mail', '=', $email)->first();
        }

        if ($user == '' or $user == null) {
            $accountType = 3;
            $user = Prospects::where('Email', '=', $email)->first();
        }
        session(['Category_code' => '']);

        if ($user == '' or $user == null) {
            return redirect('/')->with('error', 'Invalid credentials. Kindly check your email or password');
        } else {
            if (Hash::check($password, $user['Portal Password'])) {
                if($request->email == 'aodero@fke-kenya.org'){
                    session(['isDocumentsAdmin' => true]);
                }
                if ($accountType == 3) {
                    $data = getfilteredNavData('Prospects', 'No', $user['No'])['value'];
                    foreach ($data as $value) {
                    }
                    if ($value) {
                        $data = $data[0];
                    }
                    return view('/pay/payRegistration')->with('success', 'Account Created Successfully. Kindly proceed to pay the fees below')
                                                       ->with('data', $data);

                } else if ($accountType == 2) {
                    $main = Customer::where('No_', '=', $user['Client Code'])->first();
                    session(['member_no' => $main['No_']]);
                    session(['username' => $main['Name']]);
                    session(['membertype' => $main['Member Type']]);
                    session(['today' => $today]);
                    session(['status' => $main['Status']]);
                    if ($main['Member Type'] == 'ASSOCIATION') {
                        session(['association_code' => $user['No_']]);
                        //Get if FKE Offers Secretariet or not;
                        session(['Category_code' => $main['Member Category']]);
                    }

                    if ($main['Image'] !== '') {
                        $image = $this->getLogo($main['No_'],1);
                    }
                    //echo $image; exit;
                    session(['logo' => $image]);

                    //User Profile:
                    session(['contact' => $user['Name']]);
                    if ($user['Image'] !== '') {
                        $profileimage = $this->getLogo($user['No_'],$accountType);
                    }
                    //echo $image; exit;
                    session(['profileimage' => $profileimage]);

                } else {
                    session(['member_no' => $user['No_']]);
                    session(['username' => $user['Name']]);
                    session(['today' => $today]);
                    session(['status' => $user['Status']]);
                    if ($user['Member Type'] == 'ASSOCIATION') {
                        session(['association_code' => $user['No_']]);
                    }
                    
                    if ($user['Image'] !== '') {
                        $image = $this->getLogo($user['No_'],$accountType);
                    }
                    //echo $image; exit;
                    session(['logo' => $image]);

                    if ($user['Contact Person Name'] !== '' or $user['Contact Person Name'] !== null) {
                        session(['contact' => $user['Contact Person Name']]);
                    } else {
                        session(['contact' => 'Super User']);
                    }
                    session(['profileimage' => $image]);
                    session(['membertype' => $user['Member Type']]);
                }
                if ((session('status') == '4') || (session('status') == '6') || (session('status') == '7')) {
                    $data = getfilteredNavData('Customers', 'No', session('member_no'))['value'];
                    foreach ($data as $value) {
                    }
                    if ($value) {
                        $data = $data[0];
                    }
                    $data['Total_Payable'] = $data['Member_Balances'];

                    return view('/pay/payRegistration')->with('success', 'Your Account has been Disabled. Kindly renew your subscription!')
                                                       ->with('data', $data);
                } else {
                    return redirect('/alldownloads')->with('user', $user);
                }
            } else {
                return redirect('/')->with('error', 'You keyed in a wrong password');
            }
        }
    }

    public function getLogo($accno, $accountType = 1)
    {
        $attachment = '';
        $contentType = '';
        $fileName = '';

        $service = new NTLMSoapClient(config('app.webService'));
        if (!isset($params)) {
            $params = new \stdClass();
        }

        $params->accountNo = $accno;
        $params->accountType = $accountType;
        $params->attachment = $attachment;
        $params->contentType = $contentType;
        $params->fileName = $fileName;
        $result = $service->FnGetCustomerLogo($params);
        $data = base64_decode($result->attachment);

        //just to force download by the browser
        $content = $result->contentType;
        $type = substr($content, 0, strpos($content, '/'));

        if ($type == 'image') {
            return ('"data:' . $content . ';base64,' . $result->attachment . '"');
        }
    }

    public function dashboard()
    {
        //dd(session()->all());
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $active = 'Yes';
                $totalPayable = 0;
                //GetCustomer:
                $MyProfile = getfilteredNavData('Customers', 'No', session('member_no'))['value'];
                foreach ($MyProfile as $value) {
                }

                if ($value) {
                    $MyProfile = $MyProfile[0];
                    $date =  DateTime::createFromFormat("Y-m-d", $MyProfile['Joining_Date']); 
                    //echo $date->format('Y');
                    $JoinYear = $date->format('Y');
                    $CurrYear = date('Y');

                    if ($JoinYear == $CurrYear) {                        
                        $totalPayable = $MyProfile['Total_Payable'];
                    } else {
                        $totalPayable = $MyProfile['Total_Subscription_Fees'];
                    }
                }

                session(['totalPayable' => $totalPayable]);

                $sessionAnnouncements = count(vegetfilteredNavData('Announcements', 'Active', 'No')['value']);

                session(['Announcements' => $sessionAnnouncements]);

                $Announcement = end(getfilteredNavData('Announcements', 'Active', $active)['value']);

                if (($Announcement == NULL) || ($Announcement == '')) {
                    $active = 'Default';
                    $Announcement = end(getfilteredNavData('Announcements', 'Active', $active)['value']);
                }

                //Get Events:                
                $UpcomingEvent = getNavData('UpcomingEvents')['value'][0];
                $date = date_create($UpcomingEvent['Event_Start_Date']);
                $UpcomingEvent['Event_Start_Date'] =  date_format($date, "l d F Y ");

                //Get Pending and Approved Trainings that are yet to happen:
                $MyTrainings = getfilteredNavData('MyTrainings', 'Account_No', session('member_no'))['value'];
                $Pending = 'Pending Approval';
                $Approved = 'Approved';
                $ActiveTrainings = array_filter($MyTrainings, function ($var) use ($Pending, $Approved) {
                    return ($var['Status'] == $Pending || $var['Status'] == $Approved);
                });
                $TrainingCount = count($ActiveTrainings);

                //Get Active Services:
                $AllServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'))['value'];
                $MyServices = array_filter($AllServices, function ($var) {
                    return ($var['Status'] == 'Pending' || $var['Status'] == 'Active');
                });
                $ServicesCount = count($MyServices);


                //GetCustomerLedgerEntries:
                $AllLedgerEntries = getfilteredNavData('Cust_LedgerEntries', 'Customer_No', session('member_no'))['value'];
                $MyLedgerEntries = array_filter($AllLedgerEntries, function ($var) {
                    return ($var['Reversed'] == false);
                });

                //Membership Templates:
                $AllMembershipTemps = getfilteredNavData('Attachments', 'Document_Type', 'Template')['value'];
                $MembershipTemps = array_slice(array_filter($AllMembershipTemps, function ($Attachment) {
                    return ($Attachment['File_Type'] != 'Other');
                }), -5, 5);

                //dd($MembershipTemps);

                return view('dashboard')->with('MyProfile', $MyProfile)
                    ->with('Announcement', $Announcement)
                    ->with('UpcomingEvent', $UpcomingEvent)
                    ->with('TrainingCount', $TrainingCount)
                    ->with('ServicesCount', $ServicesCount)
                    ->with('MyLedgerEntries', $MyLedgerEntries)
                    ->with('MembershipTemps', $MembershipTemps);

            } catch (Exception $e) {
                return redirect('/')->with('error', $e->getMessage());
            }
        }
    }

    public function requestservice(REQUEST $request)
    {
        $this->validate($request, [
            'service' => 'required'
        ]);

        if ($request->service == 'Training')
        {
            return redirect("/alltrainings")->with('success', 'Kindly Register or Request for any of the enlisted Trainings');

        } else if ($request->service == 'Service')
        {
            return redirect("/myservices")->with('success', 'Proceed to create a new service request.');

        } else if ($request->service == 'Appointment')
        {
            return redirect("/newappointments")->with('success', 'Proceed to initiate a new appointment request.');;
        } else {
            return redirect('/dashboard', 'Invalid Request Selected!');
        }
    }


    public function createaccount(REQUEST $request)
    {
        $this->validate($request, [
            'businessname' => 'required',
            'compreg' => 'required',
            'postal_address' => 'required',
            'physical_address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'branch' => 'required',
            'memberType' => 'required',
            'contactperson' => 'required',
        ]);
        /*                   
            'contactemail' => 'required',
            'contactphone' => 'required',
        */

        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $regno = $request->compreg;
            $token = Str::random(50);
            $params->businessname = $request->businessname;
            $params->phone = $request->phone;
            $params->email = $request->email;
            $params->postal_address = $request->postaladdress;
            $params->companyReg = $request->compreg;
            $params->physical_address = $request->physical_address;
            $params->branch = $request->branch;
            $params->memberType = $request->memberType;
            $params->contact = $request->contactperson;
            //$params->contactMail = $request->contactemail;
            //$params->contactTel = $request->contactphone;
            $params->token = $token;
            $result = $service->CreateAccount($params);
            foreach ($result as $value) {
            }
            if ($value) {
                return redirect("/register-2/$regno")->with('success', 'A Verification Email has been sent to '.$request->email.'. To Proceed kindly Verify your Account by clicking the provided link.');
            } else {
                return redirect('error', 'Could not save info');
            }
        } catch (Exception $e) {
            return redirect('/register')->with('error', $e->getMessage());
        }
    }

    public function createaccountstep2(REQUEST $request)
    {
         //Check if Account Verified 
         $regno = strtoupper($request->compreg);
         $data = getfilteredNavData('Prospects', 'Incorporation_No', '*'.$regno)['value'];
         foreach ($data as $value) {
             
         }
        if ($value) {
            $data = $data[0];
        }
         if (!$data['Verified']) {
            return redirect('/register-2/'.$regno)->with('error','The user Must be authenticated before submitting this info. Vheck your email and Click the Verify Account link.');
         }
        $this->validate($request, [
            'natureofbusiness' => 'required',
            'industry' => 'required',
            //'website' => 'required',
            'location' => 'required',
            'maleemployees' => 'required',
            'femaleemployees' => 'required',
            'compreg' => 'required',
            //'business_permit' => 'required',
            //'nssf' => 'required',
            'category' => 'required',
            'password' => 'required',

        ]);
        if ($request->natureofbusiness == 'Profit Making Institution') {
            $typeofbiz = 1;
        } else if ($request->natureofbusiness == 'Educational/Medical Institution') {
            $typeofbiz = 2;
        } else if ($request->natureofbusiness == 'Charitable/Religious Institution') {
            $typeofbiz = 3;
        }

        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->natureofbusiness = $typeofbiz;
            $params->industry = $request->industry;
            $params->industryDescription = $request->industryDescription;
            $params->website = $request->website;
            $params->location = $request->location;
            $params->maleemployees = $request->maleemployees;
            $params->femaleemployees = $request->femaleemployees;
            $params->category = $request->category;
            $params->companyReg = $request->compreg;
            $params->establishmentdate = $request->establishmentdate;
            $params->krapin = $request->krapin;
            $params->password = Hash::make($request->password);
            $result = $service->CreateAccount2($params);
            foreach ($result as $value) {
            }
            if ($request->hasFile('business_permit')) {
                $binary_business_permit = base64_encode(file_get_contents($request->file('business_permit')));
                //$filename = pathinfo($request->file('business_permit')->getClientOriginalName(),PATHINFO_FILENAME);
                $filename = $request->file('business_permit')->getClientOriginalName();
                $ext = $request->file('business_permit')->getClientOriginalExtension();

                $service3 = new NTLMSoapClient(config('app.webService'));
                if (!isset($params3)) {
                    $params3 = new \stdClass();
                }
                $params3->docNo = $regno;
                $params3->fileName = $filename;
                $params3->attachment = $binary_business_permit;
                $params3->tableID = 50003;
                $result3 = $service3->UploadAttachedDocument($params3);
            }//else{
            //    return redirect("/register-2/$regno")->with('error', 'Please attach your business permit');
            //}
            if ($request->hasFile('nssf')) {
                $binary_nssf = base64_encode(file_get_contents($request->file('nssf')));
                $filename = $request->file('nssf')->getClientOriginalName();
                $service3 = new NTLMSoapClient(config('app.webService'));
                if (!isset($params3)) {
                    $params3 = new \stdClass();
                }
                $params3->docNo = $regno;
                $params3->fileName = $filename;
                $params3->attachment = $binary_nssf;
                $params3->tableID = 50003;
                $result3 = $service3->UploadAttachedDocument($params3);
            }//else{
             //   return redirect("/register-2/$regno")->with('error', 'Please attach the nssf document');
            //}

            $data = getfilteredNavData('Prospects', 'Incorporation_No', '*'.$regno)['value'];
            foreach ($data as $value) {
            }
            if ($value) {
                $data = $data[0];
            }

            if ($value) {
                //return redirect("/paymentregistration")->with('data', $data);
                return view('/pay/payRegistration')->with('success', 'Account Created Successfully. Kindly proceed to pay the fees below')
                    ->with('data', $data);
            } else {
                return redirect('error', 'Could not save info');
            }
        } catch (Exception $e) {
            return redirect("/register-2/$regno")->with('error', $e->getMessage());
        }
    }

    public function emailVerification($token,$IncNo){
        //Mark the user as Verified:
        $CheckVerified = Prospects::where('Verification Token', '=', $token)->where('Incorporation No', '=', $IncNo)->first();
        if ($CheckVerified == null) {
            return redirect('/')->with('error', 'The Record to be verified does not exist. To Proceed Kindly Sign up!');
        }

        $user = Prospects::where('Verification Token', '=', $token)->where('Incorporation No', '=', $IncNo)->update([
            'Verified' => true
         ]);

         return redirect("/register-2/$IncNo")->with('Success','The Account was Successfully Verified. Kindly Proceed and fill out details below.');
    }

    public function resendVerification($IncNo) {
        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->incno = $IncNo;
            $result = $service->FnResendEmail($params);
            
            foreach ($result as $value) {
            }
            if ($value) {
                return redirect("/register-2/$IncNo")->with('Success','You will Receive the Verification Email Shortly.');
            } else {
                return redirect('error', 'Could not Resend Verification Email');
            }
        } catch (Exception $e) {
            return redirect("/register-2/$IncNo")->with('error', $e->getMessage());
        }
         
    }
    public function forgotPassword(REQUEST $request) {
        $memberno = $request->memberno;
        $domain = request()->root();
        $members_endpoint = "customers";
        $contacts_endpoint = "MyContacts";
    
        try {
            // Check if member number exists in the customers endpoint
            $get_member = getfilteredNavData($members_endpoint, 'No', $memberno);
    
            if (empty($get_member['value'])) {
                // If not found in customers, check the MyContacts endpoint
                $get_contact = getfilteredNavData($contacts_endpoint, 'No', $memberno);
                
                if (empty($get_contact['value'])) {
                    return redirect('/')->with('error', 'Member not found.');
                }
                
                // Member found in MyContacts, use FnForgotPortalPasswordContact service
                $service_name = 'FnForgotPortalPasswordContact';
            } else {
                // Member found in customers, use FnForgotPortalPassword service
                $service_name = 'FnForgotPortalPassword';
            }
    
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->customerNo = $memberno;
            $result = $service->$service_name($params);
    
            if ($result->return_value) {
                $request->session()->forget('reset_email');
                return redirect('/')->with('success', 'A token that you will use to reset your password has been successfully sent to your email. Use it to reset your password.');
            }
    
            return redirect('/')->with('success', 'Check your email for a verification link and token.');
    
        } catch (Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }
    }

    public function resetPassword(REQUEST $request) {
        $memberno = $request->memberno;
        $resetToken = $request->resetToken;
        $newPassword = $request->newPassword;
        $domain = request()->root();

        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->customerNo = $memberno;
            $params->resetToken = $resetToken;
            $params->newPassword =Hash::make($newPassword); 
            // var_dump($params).exit;
            $result = $service->FnResetPortalPassword($params);
            
            if ($result->return_value) {
                $request->session()->forget('reset_email');
                return redirect('/')->with('success', 'Your password has been  reset successfully. Proceed to login.');
            }
            // Mail::send(new resetMail($memberno,$domain));
            return redirect('/')->with('success', 'Check Eemail for a verification link and token.');

        } catch (Exception $e) {
            return redirect("/")->with('error', $e->getMessage());
        }
         
    }
    public function newPassword(REQUEST $request) {
        $password = $request->password;
        $password2 = $request->password2;

        
        if ($password != $password2){
            return redirect('/verify')->with('error', 'Password Mismatch');
        }
        else {
            $user = getfilteredNavData('Customers', 'E_Mail', session('reset_email'))['value'];
            foreach($user as $value){
                if($value['E_Mail'] == session('reset_email')){
                    $MemberNo = $value['No'];
                }
            }
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }

            $params->memberno = $MemberNo;
            $params->password = Hash::make($password);
            $result = $service->FnUpdatePassword($params);
            if ($result->return_value) {
                $request->session()->forget('reset_email');
                return redirect('/')->with('success', 'You have successfully updated you password. Login to proceed.');
            }
        }
         
    }
    public function verify(REQUEST $request) {

        try {
            return view('profile/verify');
        } catch (Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }

         
    }

    public function industries()
    {
        $query = Industries::all();
        echo "<option value='' selected>--Select Industry--</option>\n";
        foreach ($query as $row) {
            $Industry = $row['Industry'];
            $Description = $row['Industry Description'];
            echo "<option value='$Industry'>$Description</option>";
        }
    }

    public function TemplateDownloads(){
        $path=public_path('storage/attendees.xlsx');
        return response()->download($path);
    }

    public function notifications()
    {
        $Announcements = vegetfilteredNavData('Announcements', 'Active', 'No')['value'];
        return view('announcements.notifications')->with('Announcements', $Announcements);
    }
    public function employees()
    {
        $emps = Employees::where('Allow Appointments', '=', 1)->get();
        
        echo "<option value='' selected>-- Select -- </option>\n";
        foreach ($emps as $row) {
            if (!empty($row['User Name']))
            {
                $value = $row['User ID'];
                $text = $row['User Name'];
    
                echo "<option value='$value'>$text</option>";

            }
        }
    }
}

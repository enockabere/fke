<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Contacts;
use App\Models\Designations;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function myProfile()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $username = session('username');

                $MyProfile = getfilteredNavData('Customers', 'No', $MembNo)['value'];
                
                foreach ($MyProfile as $value) {
                }
                if ($value) {
                    $MyProfile = $MyProfile[0];
                }

                return view('profile/myprofile')->with('MyProfile', $MyProfile)
                                                ->with('username', $username)
                                                ->with('regno', $MyProfile['No']);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }
    public function Contact()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $username = session('username');

                $MyProfile = getfilteredNavData('Customers', 'No', $MembNo)['value'];
                
                foreach ($MyProfile as $value) {
                }
                if ($value) {
                    $MyProfile = $MyProfile[0];
                }

                return view('profile/contact')->with('MyProfile', $MyProfile)
                                                ->with('username', $username)
                                                ->with('regno', $MyProfile['No']);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }
    public function mailNotify(REQUEST $request)
    {
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        
        try {
            Mail::send(new MailNotify($name,$email,$subject,$message));
            return redirect('/contact')->with('success', 'Successfully Sent');
        } catch (Exception $e) {
            return redirect('/contact')->with('error', 'Sorry,something went wrong.');
        }

    }

    public function updateProfile(REQUEST $request)
    { 
      /*  
        {
            $this->validate($request, [
                'email' => 'required',
                'compreg' => 'required',
                'phone' => 'required'
            ]);
        }
        */
        $typeofbiz = 0;

        if ($request->natureofbusiness == 'Profit Making Institution') {
            $typeofbiz = 1;
        } else if ($request->natureofbusiness == 'Educational/Medical Institution') {
            $typeofbiz = 2;
        } else if ($request->natureofbusiness == 'Charitable/Religious Institution') {
            $typeofbiz = 3;
        }

        if (empty($request->employees)) {
            $request->employees = 0;
        }

        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->accountno = session('member_no');
            $params->businessname = $request->businessname;
            $params->phone = $request->phone;
            $params->email = $request->email;
            $params->companyReg = $request->compreg;
            $params->physical_address = $request->physical_address;
            $params->natureofbusiness = $typeofbiz;
            $params->employees = $request->employees;
            $params->category = $request->category;
            $params->nextno = '';
            $params->kraPinNo=$request->kraPinNo;
            $result = $service->FnUpdateAccount($params);
            $updateno = $result->nextno;

            foreach ($result as $value) {
            }

            if ($request->hasFile('businesspermit')) {
                $binary_business_permit = base64_encode(file_get_contents($request->file('businesspermit')));
                $filename = $request->file('businesspermit')->getClientOriginalName();

                $service3 = new NTLMSoapClient(config('app.webService'));
                if (!isset($params3)) {
                    $params3 = new \stdClass();
                }
                $params3->docNo = $updateno;
                $params3->fileName = $filename;
                $params3->attachment = $binary_business_permit;
                $params3->tableID = 50030;
                $result3 = $service3->UploadAttachedDocument($params3);
            }
            if ($request->hasFile('nssfcertificate')) {
                $binary_nssf = base64_encode(file_get_contents($request->file('nssfcertificate')));
                $filename = $request->file('nssfcertificate')->getClientOriginalName();
                $service3 = new NTLMSoapClient(config('app.webService'));
                if (!isset($params3)) {
                    $params3 = new \stdClass();
                }
                $params3->docNo = $updateno;
                $params3->fileName = $filename;
                $params3->attachment = $binary_nssf;
                $params3->tableID = 50030;
                $result3 = $service3->UploadAttachedDocument($params3);
            }

            if (!$value) {
                return redirect('/myprofile')->with('error', 'Could not save info');
            } else {

                return redirect('/myprofile')->with('success', 'The Change Request was Successfully Submitted and will be effected on approval!');
            }
        } catch (Exception $e) {
            return redirect('/myprofile')->with('error', $e->getMessage());
        }
    }

    public function updatePassword(REQUEST $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:4',
            'passwordconfirmation' => 'required|same:newpassword'
        ]);

        $MemberNo = session('member_no');
        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;

        $user = Customer::where('No_', '=', $MemberNo)->first();

        if ($user == '' or $user == null) {
            return redirect('/')->with('error', 'The user does not exist.');
        } else {
            if (!(Hash::check($oldpassword, $user['Portal Password']))) {
                return redirect('/myprofile')->with('error', 'The submitted password is incorrect. Kindly Check your old password!');
            } else {
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->memberno = $MemberNo;
                $params->newpassword = Hash::make($newpassword);
                $result = $service->FnUpdatePassword($params);
                if ($result->return_value) {
                    return redirect('/')->with('success', 'You have successfully updated you password. Login to proceed.');
                }
            }
        }
    }

    public function getUsers()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $AllContacts = getfilteredNavData('MyContacts', 'No', $MembNo)['value'];
                $MyContacts = array_filter($AllContacts, function ($contact) {
                    return ($contact['Contact_Type'] == 'Member' && $contact['Type'] == 'Person');
                });
                $DefaultContact = array_slice($MyContacts, 0, 1);

                return view('users/all_users')->with('DefaultContact', $DefaultContact)
                    ->with('MyContacts', $MyContacts);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }
    public function getAssociatedCompanies()
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $AllContacts = getfilteredNavData('MyContacts', 'No', $MembNo)['value'];
                $MyCompanies = array_filter($AllContacts, function ($contact) {
                    return ($contact['Contact_Type'] == 'Member' && $contact['Type'] == 'Company');
                });

                return view('users/all_companies')->with('MyCompanies', $MyCompanies);
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function addUser($user)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {

                if ($user == 'Contact') {
                    return view('users/add_user')->with('userType', $user);
                } else if ($user == 'Associate') {
                    return view('users/add_associated_company')->with('userType', $user);
                }
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function createUser(REQUEST $request)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $this->validate($request, [
                    'password' => 'required',
                    'passwordconfirmation' => 'required|same:password'
                ]);

                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                if ($request->accounttype == 'Main Account') {
                    $accounttype = 1;
                } else if ($request->accounttype == 'Associate Account') {
                    $accounttype = 2;
                }

                if ($request->role == 'Super Administrator') {
                    $role = 1;
                } else if ($request->role == 'Administrator') {
                    $role = 2;
                } else if ($request->role == 'Contributor') {
                    $role = 3;
                }

                $params->userType = $request->usertype;
                $params->clientCode = $MembNo;
                $params->contactType = 2;
                $params->name = $request->fullname;
                $params->email = $request->email;
                $params->phoneNo = $request->phonenumber;
                $params->designation = $request->designation;
                $params->role = $role;
                $params->accountType = $accounttype;
                $params->company = $request->company;
                $params->password = Hash::make($request->password);
                $result = $service->FnAddContacts($params);

                if ($result->return_value) {
                    return redirect('/users');
                } else {
                    return redirect('/users')->with('error', 'Couldn\'t save the record. Check and Confirm that all the required fields are correctly captured!');
                }
            } catch (Exception $e) {
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function createCompany(REQUEST $request)
    {
        if (session('member_no') == '' or session('member_no') == null) {
            return redirect('/')->with('error', 'Session Expired. Kindly Login again');
        } else {
            try {
                $MembNo = session('member_no');
                $nextNo = '';

                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->userType = $request->usertype;
                $params->clientCode = $MembNo;
                $params->contactType = 2;
                $params->name = $request->companyname;
                $params->email = $request->companyemail;
                $params->phoneNo = $request->phonenumber;
                $params->website = $request->website;
                $params->address = $request->address;
                $params->postcode = $request->postcode;
                $params->city = $request->city;
                $params->employees = $request->employees;
                $params->nextNo = $nextNo;
                $result = $service->FnAddCompany($params);

                if ($request->hasFile('business_permit')) {
                    $binary_business_permit = base64_encode(file_get_contents($request->file('business_permit')));
                    $filename = $request->file('business_permit')->getClientOriginalName();

                    $service3 = new NTLMSoapClient(config('app.webService'));
                    if (!isset($params3)) {
                        $params3 = new \stdClass();
                    }
                    $params3->docNo = $result->nextNo;
                    $params3->fileName = $filename;
                    $params3->attachment = $binary_business_permit;
                    $params3->tableID = 50016;
                    $result3 = $service3->UploadAttachedDocument($params3);
                } else
                {
                    dd('No such file');
                }
                if ($request->hasFile('nssf')) {
                    $binary_nssf = base64_encode(file_get_contents($request->file('nssf')));
                    $filename = $request->file('nssf')->getClientOriginalName();
                    $service3 = new NTLMSoapClient(config('app.webService'));
                    if (!isset($params3)) {
                        $params3 = new \stdClass();
                    }
                    $params3->docNo = $result->nextNo;
                    $params3->fileName = $filename;
                    $params3->attachment = $binary_nssf;
                    $params3->tableID = 50016;
                    $result3 = $service3->UploadAttachedDocument($params3);
                }

                if ($result->return_value) {
                    return redirect('/associatedcompanies');
                } else {
                    return redirect('/associatedcompanies')->with('error', 'Couldn\'t save the record. Check and Confirm that all the required fields are correctly captured!');
                }
            } catch (Exception $e) {
                return redirect('/associatedcompanies')->with('error', $e->getMessage());
            }
        }
    }

    public function companies()
    {
        $query = Contacts::WHERE('Client Code', '=', session('member_no'))->where('Type', '=', 0)->where('Company No_', '!=', '')->get();
        echo "<option value='' selected>--Select--</option>\n";
        foreach ($query as $row) {
            $value = $row['Company No_'];
            if ($row['Company Name']) {
                $text = $row['Company Name'];
            } else {
                $text = $row['Name'];
            }
            echo "<option value='$value'>$text</option>";
        }
    }

    public function designations()
    {
        $query = Designations::get();
        echo "<option value='' selected>--Select Designation--</option>\n";
        foreach ($query as $row) {
            $Designation = $row['Designation'];
            $Description = $row['Designation Description'];
            echo "<option value='$Designation'>$Description</option>";
        }
    }

    
    public function downloadCertificate($membno){
        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }

            $params->custno = $membno;
            $params->filenamefromapp = $membno.".pdf";
            $result = $service->FnGenerateCertificate($params);
            return response()->file("C:\\Portal Downloads\\".$membno.".pdf");
        }catch (Exception $e){
            return redirect ('/myprofile')->with('error', $e->getMessage());
        }
    }
}
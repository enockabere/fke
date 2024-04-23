<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;
use DateTime;

class DownloadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function allDownloads()
    {
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
                //Get Active Services:
                $AllServices = getfilteredNavData('MyServices', 'Member_No', session('member_no'))['value'];
                $MyServices = array_filter($AllServices, function ($var) {
                    return ($var['Status'] == 'Pending' || $var['Status'] == 'Active');
                });
                
                $ServicesCount = count($MyServices);

                $portaDocs = getNavData('QyNewPortalDocuments')['value'];

                $labourLaws = array();
                $EmploymentRelation = array();
                $DisciplineSeparation = array();
                $IndustrialLabour = array(); 
                $WorkingEnvironment = array();
                $BusinessPractices = array();
                $MemberServices = array();
                $FAQs = array();
        
                foreach($portaDocs as $value){
                    if($value['Category'] == '06'){
                        array_push($labourLaws, $value);
                    }
                    if($value['Category'] == '04'){
                        array_push($EmploymentRelation, $value);
                    }
                    if($value['Category'] == '03'){
                        array_push($DisciplineSeparation, $value);
                    }
                    if($value['Category'] == '05'){
                        array_push($IndustrialLabour, $value);
                    }
                    if($value['Category'] == '08'){
                        array_push($WorkingEnvironment, $value);
                    }
                    if($value['Category'] == '02'){
                        array_push($BusinessPractices, $value);
                    }
                    if($value['Category'] == '07'){
                        array_push($MemberServices, $value);
                    }
                    if($value['Category'] == '01'){
                        array_push($FAQs, $value);
                    }
                }


            return view('/downloads/downloads')->with('labourLaws',$labourLaws)
                                                        ->with('EmploymentRelation',$EmploymentRelation)
                                                        ->with('DisciplineSeparation',$DisciplineSeparation)
                                                        ->with('IndustrialLabour',$IndustrialLabour)
                                                        ->with('WorkingEnvironment',$WorkingEnvironment)
                                                        ->with('BusinessPractices',$BusinessPractices)
                                                        ->with('MemberServices',$MemberServices )
                                                        ->with('FAQs',$FAQs )
                                                        ->with('MyProfile', $MyProfile)
                                                        ->with('ServicesCount', $ServicesCount);
        } catch (Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }
    }
    }

    public function myDownloads()
    {
        $AllDocuments = getfilteredNavData('MyDownloads', 'Member_Number', session('member_no'))['value'];
        $Documents = array_filter($AllDocuments, function($Attachment) {
            return($Attachment['File_Type'] != 'Other' && $Attachment['Document_Reference_ID'] != '');
        });
        
        $portaDocs = getNavData('QyFKEPortalDocuments')['value'];



        return view('/downloads/mydownloads')->with('Documents', $Documents);
    }

    public function getAttachment($id,$type,$ext)
    {
        $attachment = getfilteredNavData('QyPortalDocumentsAttachment', 'ID', $id)['value'][0];
        $contentType = '';
        $fileName = $attachment['File_Name'];
        try{
            $service = new NTLMSoapClient(config('app.webService'));
            if(!isset($params)){
                $params = new \stdClass();
            }

            $memberno = session('member_no');

            $params->entryNo = $id;
            $params->memberNo = $memberno;
            $params->attachment = '';
            $params->contentType = $contentType;
            $params->contentType = $contentType;
            $params->fileName = $fileName;
            $result = $service->FnGetAttachments($params);
            $data = base64_decode($result->attachment);

            //just to force download by the browser
            $content = $result->contentType;

            if($type == 'Image') {
                echo '<img src="data:image/'.$ext.';base64,' . $result->attachment . '" />';
             } elseif ($type == 'Word') {
                    $file_name =$fileName.".$ext";
                    $headers = [
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'Content-Disposition' => 'attachment; filename="'.$file_name.'"'
                    ];
                    return response($data, 200, $headers);
            } else {
                header("Content-type: ".$content);
                echo $data;
            }

        }catch(Exception $e){
            return redirect('/dashboard')->with('error', $e->getMessage());
        }
    }
    public function searchResults($ext)
    {
        $searchQuery = $ext;
        $filter = "(contains(Body, '$searchQuery'))";
        $filtered = filterData('QyDocumentCategoryLine',$filter);
        if($filtered != null)
            {
                $documents = $filtered['value'];

            }

        return view('/downloads/results')->with('data',$documents)
                                                ->with('searchQuery',$searchQuery);
    }
    public function SearchContent(REQUEST $request)
    {
        $searchQuery = $request->searchQuery;
        return redirect("/results/$searchQuery");
    }
    public function singleDownload($id,$type)
    {
        $data = getfilteredNavData('QyNewPortalDocuments', 'Code', $id)['value'][0];
        $data["ExternalLinks"] = "";
        $data["Templates"] = "";
        $blobText = $this->GetDocContent($id);
        $blobTexts = explode("## ",$blobText);
        $data["Content"] = $blobTexts[0];
        if(count($blobTexts) > 1){
            $data["ExternalLinks"] = $blobTexts[1];
        }
        if(count($blobTexts) > 2){
            $data["Templates"] = $blobTexts[2];
        }
        //attachments
        //$data['attachments'] = filterData('QyAttachments',"No eq '$id' and Table_ID eq 50157 and ((File_Extension eq 'pdf' or File_Extension eq 'xlsx' or File_Extension eq 'csv' or File_Extension eq 'docx'))");
        $data['attachments'] = filterData('QyAttachments',"No eq '$id' and Table_ID eq 50157 and (File_Type eq 'Image' or File_Type eq 'Word' or File_Type eq 'PDF' or File_Type eq 'Excel' or File_Type eq 'PowerPoint')")['value'];
        return view('/downloads/singleDownload')->with('data', $data);
    }
    function GetDocContent($code){
        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->code = $code;
            $result = $service->FnGetAttachmentContent($params);
            return $result->return_value;
        } catch (Exception $e) {
            
            return null;
        }
    }
    function ViewDocumentAttachment($docId,$name,$type){
        try {
            $service = new NTLMSoapClient(config('app.webService'));
            if (!isset($params)) {
                $params = new \stdClass();
            }
            $params->docId = $docId;
            $result = $service->FnGetPortalDocumentTemplateBase64($params);
            if($result->return_value != ""){
				$data = base64_decode($result->return_value);
                if($type == "pdf"){
                    header('Content-Type: application/pdf');
                }else{
                    if($type == "xlsx" || $type == "csv"){
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    }
                    else if($type == "docx" || $type == "doc"){
                        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    }
                }
                header("Content-Disposition:attachment;filename=\"$name.$type\"");
                ob_clean();
                ob_end_flush();
                echo $data;
			}else{
                return redirect()->back()->with('error','Oops! Something went wrong.'.config('app.errors')['persists']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','Oops! Something went wrong.'.config('app.errors')['persists']);
        }
    }
}
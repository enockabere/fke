<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;

class DocumentsAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('documentsAdmin');
    }
    public function index()
    {
        $records = getNavData('QyNewPortalDocuments');
        $data = $records['value'];
        return view('documents-admin.index')->with('data', $data);
    }
    public function create()
    {
        try {
            $categories = getNavData('QyPortalDocumentCategories');
            $categories = $categories['value'];
            $data['myAction'] = 'create';
            $data['categories'] = $categories;
            $data["Content"] = "";
            $data["ExternalLinks"] = "";
            $data["Templates"] = "";
            return view('documents-admin.show-edit')->with('data', $data);
        } catch (Exception $e) {
            return redirect('/documents-admin')->with('error', $e->getMessage());
        }
    }
    public function showEdit($code)
    {
        try {
            $data = getfilteredNavData('QyNewPortalDocuments', 'Code', $code)['value'][0];
            $categories = getNavData('QyPortalDocumentCategories')['value'];
            $data['myAction'] = 'edit';
            $data['categories'] = $categories;
            $blobText = $this->GetDocContent($code);
            $blobTexts = explode("## ", $blobText);
            $data["Content"] = $blobTexts[0];
            $data["ExternalLinks"] = "";
            if (count($blobTexts) > 1) {
                $data["ExternalLinks"] = $blobTexts[1];
            }
            $data["Templates"] = "";
            if (count($blobTexts) > 2) {
                $data["Templates"] = $blobTexts[2];
            }
            return view('documents-admin.show-edit')->with('data', $data);
        } catch (Exception $e) {
            return redirect('/documents-admin')->with('error', $e->getMessage());
        }
    }


    public function createUpdate(REQUEST $request)
    {
            try {
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->code = $request->myAction == 'edit'? $request->code:'';
                $params->myAction = $request->myAction == 'edit'? 'modify':'insert';
                $params->category = $request->category;
                $params->content = $request->content;
                $params->templates = $request->templates;
                $params->externalLinks = $request->externalLinks;
                $params->sequence = $request->sequence;
                $params->title = $request->title;
                $result = $service->FnNewPortalDocuments($params);
                if ($result->return_value) {
                    return redirect('/documents-admin')->with('success', 'Update successful');
                }
                return redirect('/documents-admin')->with('error', 'Something went wrong.');
            } catch (Exception $e) {
                return redirect('/documents-admin')->with('error', $e->getMessage());
            }
    }
    public function deleteDoc(REQUEST $request)
    {
            try {
                $service = new NTLMSoapClient(config('app.webService'));
                if (!isset($params)) {
                    $params = new \stdClass();
                }

                $params->code = $request->code;
                $result = $service->FnDeleteNewPortalDocument($params);
                if ($result->return_value) {
                    return redirect('/documents-admin')->with('success', 'Deleted successfully');
                }
                return redirect('/documents-admin')->with('error', 'Something went wrong.');
            } catch (Exception $e) {
                return redirect('/documents-admin')->with('error', $e->getMessage());
            }
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
    
}
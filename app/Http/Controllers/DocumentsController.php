<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClasses\NTLM\NTLMSoapClient;
use Exception;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticateUser');
        $this->middleware('validateBalance');
    }
    public function index()
    {
        if(isset($_GET['search'])){
            $searchQuery = $_GET['search'];
            $searchBy = $_GET['by'];
            if($searchBy == 2){
                $filter = "(contains(Body, '$searchQuery'))";
            }else{
                $filter = "(contains(Title, '$searchQuery'))";
            }
            //$filter = "(contains(Body, '$searchQuery')) or ";
            $filtered = filterData('FKEDocuments',$filter);
            if($filtered != null)
            {
                $documents = $filtered['value'];
            }else{
                return redirect()->back();
            }
            
        }else{
            $documents = getNavData('FKEDocuments')['value'];
        }
        // dd($documents);
        return view('documents.index')->with('data', $documents);
    }

    public function show($code)
    {
        $document = getfilteredNavData('FKEDocuments','Code',$code)['value'];
        $document = $document[0];
        return view('documents.show')->with('document', $document);
    }
    
}
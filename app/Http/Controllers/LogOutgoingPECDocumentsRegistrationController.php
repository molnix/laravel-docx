<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogOutgoingPECDocumentsRegistration;
use PhpOffice\PhpWord\TemplateProcessor;

class LogOutgoingPECDocumentsRegistrationController extends Controller
{
    public function create(Request $request,$id){
        LogOutgoingPECDocumentsRegistration::where('voting_id',$id)->delete();
        if(isset($request['number'])){
            for($i=0;$i<count($request['number']);$i++){
                LogOutgoingPECDocumentsRegistration::create([
                    'voting_id'=>$id,
                    'date'=>$request['date'][$i],
                    'number'=>$request['number'][$i],
                    'recipient'=>$request['recipient'][$i],
                    'summary_document'=>$request['summary_document'][$i],
                    'person_signed_doc'=>$request['person_signed_doc'][$i],
                    'executor'=>$request['executor'][$i],
                    'case'=>$request['case'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $log_outgoing_documents=LogOutgoingPECDocumentsRegistration::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Log_of_outgoing_PEC_documents_registration.docx'));

        $values=array();
        foreach($log_outgoing_documents as $log){
            array_push($values,array(
                'date'=>$log->date,
                'number'=>$log->number,
                'recipient'=>$log->recipient,
                'summary_document'=>$log->summary_document,
                'person_signed_doc'=>$log->person_signed_doc,
                'executor'=>$log->executor,
                'case'=>$log->case,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);
        
        $doc->saveAs('Log_of_outgoing_PEC_documents_registration.docx');
        return response()->download('Log_of_outgoing_PEC_documents_registration.docx')->deleteFileAfterSend(true);
    }
}

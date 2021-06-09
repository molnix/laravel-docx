<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogIncomingDocument;
use PhpOffice\PhpWord\TemplateProcessor;

class LogIncomingDocumentController extends Controller
{
    public function create(Request $request,$id){
        LogIncomingDocument::where('voting_id',$id)->delete();
        if(isset($request['number'])){
            for($i=0;$i<count($request['number']);$i++){
                LogIncomingDocument::create([
                    'voting_id'=>$id,
                    'date_receipt'=>$request['date_receipt'][$i],
                    'number'=>$request['number'][$i],
                    'correspondent'=>$request['correspondent'][$i],
                    'number_doc'=>$request['number_doc'][$i],
                    'date_doc'=>$request['date_doc'][$i],
                    'content'=>$request['content'][$i],
                    'resolution'=>$request['resolution'][$i],
                    'executer'=>$request['executer'][$i],
                    'term_start'=>$request['term_start'][$i],
                    'term_end'=>$request['term_end'][$i],
                    'mark'=>$request['mark'][$i],
                    'case'=>$request['case'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $log_incoming_documents=LogIncomingDocument::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Log_of_incoming_documents.docx'));

        $values=array();
        foreach($log_incoming_documents as $log){
            array_push($values,array(
                'date_receipt'=>$log->date_receipt,
                'number'=>$log->number,
                'correspondent'=>$log->correspondent,
                'number_doc'=>$log->number_doc,
                'date_doc'=>$log->date_doc,
                'content'=>$log->content,
                'resolution'=>$log->resolution,
                'executer'=>$log->executer,
                'term_start'=>$log->term_start,
                'term_end'=>$log->term_end,
                'mark'=>$log->mark,
                'case'=>$log->case,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);
        
        $doc->saveAs('Log_of_incoming_documents.docx');
        return response()->download('Log_of_incoming_documents.docx')->deleteFileAfterSend(true);
    }
}

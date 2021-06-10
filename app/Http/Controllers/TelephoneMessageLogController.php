<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TelephoneMessageLog;
use PhpOffice\PhpWord\TemplateProcessor;

class TelephoneMessageLogController extends Controller
{
    public function create(Request $request,$id){
        TelephoneMessageLog::where('voting_id',$id)->delete();
        if(isset($request['number'])){
            for($i=0;$i<count($request['number']);$i++){
                TelephoneMessageLog::create([
                    'voting_id'=>$id,
                    'number'=>$request['number'][$i],
                    'date'=>$request['date'][$i],
                    'person_transmitting'=>$request['person_transmitting'][$i],
                    'person_transmitting_status'=>$request['person_transmitting_status'][$i],
                    'person_adopted'=>$request['person_adopted'][$i],
                    'person_adopted_status'=>$request['person_adopted_status'][$i],
                    'content'=>$request['content'][$i],
                    'note'=>$request['note'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $telephone_message_log=TelephoneMessageLog::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Telephone_message_log.docx'));

        $values=array();
        foreach($telephone_message_log as $log){
            array_push($values,array(
                'number'=>$log->number,
                'date'=>$log->date,
                'person_transmitting'=>$log->person_transmitting,
                'person_transmitting_status'=>$log->person_transmitting_status,
                'person_adopted'=>$log->person_adopted,
                'person_adopted_status'=>$log->person_adopted_status,
                'content'=>$log->content,
                'note'=>$log->note,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs('Telephone_message_log.docx');
        return response()->download('Telephone_message_log.docx')->deleteFileAfterSend(true);
    }
}

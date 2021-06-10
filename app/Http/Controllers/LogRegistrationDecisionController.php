<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\LogRegistrationDecision;

class LogRegistrationDecisionController extends Controller
{
    public function create(Request $request,$id){
        LogRegistrationDecision::where('voting_id',$id)->delete();
        if(isset($request['number'])){
            for($i=0;$i<count($request['number']);$i++){
                LogRegistrationDecision::create([
                    'voting_id'=>$id,
                    'number'=>$request['number'][$i],
                    'date'=>$request['date'][$i],
                    'name'=>$request['name'][$i],
                    'number_sheets_decisions'=>$request['number_sheets_decisions'][$i],
                    'number_sheets_applications'=>$request['number_sheets_applications'][$i],
                    'executor'=>$request['executor'][$i],
                    'note'=>$request['note'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $log_registration_decisions=LogRegistrationDecision::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Log_of_registration_of_PEC_decisions.docx'));

        $values=array();
        foreach($log_registration_decisions as $log){
            array_push($values,array(
                'date'=>$log->date,
                'number'=>$log->number,
                'name'=>$log->name,
                'number_sheets_decisions'=>$log->number_sheets_decisions,
                'number_sheets_applications'=>$log->number_sheets_applications,
                'executor'=>$log->executor,
                'note'=>$log->note,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs('Log_of_registration_of_PEC_decisions.docx');
        return response()->download('Log_of_registration_of_PEC_decisions.docx')->deleteFileAfterSend(true);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApplicationLog;
use App\ApplicationLogData;
use App\Voting;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
use Illuminate\Support\Facades\File;

class ApplicationLogController extends Controller
{
    public function create(Request $request,$id){
        $application_log=ApplicationLog::where('voting_id',$id)->first();
        if($application_log){
            ApplicationLogData::where('application_log_id',$application_log->id)->delete();
            $application_log->delete();
        }

        $application_log=ApplicationLog::create([
            'voting_id'=>$id,
            'date'=>$request['main_date'],
            'for_question'=>$request['for_question'],
        ]);
        if(isset($request['number'])){
            for($i=0;$i<count($request['number']);$i++){
                ApplicationLogData::create([
                    'application_log_id'=>$application_log->id,
                    'number'=>$request['number'][$i],
                    'date'=>$request['date'][$i],
                    'time'=>$request['time'][$i],
                    'participant_name'=>$request['participant_name'][$i],
                    'adress'=>$request['adress'][$i],
                    'person_accepted_name'=>$request['person_accepted_name'][$i],
                    'note'=>$request['note'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $voting=Voting::find($id);
        $application_logs=ApplicationLog::with('application_log_data')->where('voting_id',$id)->first();
        $doc = new TemplateProcessor(public_path('documents/required_documents/application_log.docx'));
        $doc->setValue('main_date',$application_logs->date);
        $doc->setValue('for_question',$application_logs->for_question);
        $doc->setValue('plot',$voting->plot_number);
        $values=array();
        foreach($application_logs->application_log_data as $application_log){
            array_push($values,array(
                'number'=>$application_log->number,
                'date'=>$application_log->date,
                'time'=>$application_log->time,
                'participant_name'=>$application_log->participant_name,
                'adress'=>$application_log->adress,
                'person_accepted_name'=>$application_log->person_accepted_name,
                'null'=>null,
                'note'=>$application_log->note,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs('application_log.doc');
        return response()->download('application_log.doc')->deleteFileAfterSend(true);
    }
}

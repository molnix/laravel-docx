<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voting;
use App\ProtocolAndDecisionReviewSheet;
use PhpOffice\PhpWord\TemplateProcessor;

class ProtocolAndDecisionReviewSheetController extends Controller
{
    public function create(Request $request,$id){
        ProtocolAndDecisionReviewSheet::where('voting_id',$id)->delete();
        if(isset($request['name'])){
            foreach($request['name'] as $name){
                ProtocolAndDecisionReviewSheet::create([
                    'voting_id'=>$id,
                    'name'=>$name
                ]);
            }
        }
        return redirect()->back();
    }
    public function download($id){
        $logs=ProtocolAndDecisionReviewSheet::where('voting_id',$id)->get();
        $voting=Voting::find($id);

        $doc = new TemplateProcessor(public_path('documents/required_documents/List_oznakomleniya_c_protokolom_and_resheniyami.docx'));

        $doc->setValue('plot',$voting->plot_number);
        
        $values=array();
        foreach($logs as $log){
            arraY_push($values,array(
                'name'=>$log->name,
            ));
        }
        $doc->cloneRowAndSetValues('name', $values);

        $doc->saveAs('List_oznakomleniya_c_protokolom_and_resheniyami.docx');
        return response()->download('List_oznakomleniya_c_protokolom_and_resheniyami.docx')->deleteFileAfterSend(true);
    }
}

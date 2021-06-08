<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voting;
use App\FireSafetyInformationSheet;
use PhpOffice\PhpWord\TemplateProcessor;

class FireSafetyInformationSheetController extends Controller
{
    public function create(Request $request,$id){
        FireSafetyInformationSheet::where('voting_id',$id)->delete();
        if(isset($request['name'])){
            foreach($request['name'] as $name){
                FireSafetyInformationSheet::create([
                    'voting_id'=>$id,
                    'name'=>$name
                ]);
            }
        }
        return redirect()->back();
    }
    public function download($id){
        $logs=FireSafetyInformationSheet::where('voting_id',$id)->get();

        $doc = new TemplateProcessor(public_path('documents/required_documents/List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti.docx'));
        
        $values=array();
        foreach($logs as $log){
            arraY_push($values,array(
                'name'=>$log->name,
            ));
        }
        $doc->cloneRowAndSetValues('name', $values);

        $doc->saveAs('List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti.docx');
        return response()->download('List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti.docx')->deleteFileAfterSend(true);
    }
}

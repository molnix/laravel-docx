<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolutionWorkPlan;
use App\Voting;
use PhpOffice\PhpWord\TemplateProcessor;

class SolutionWorkPlanController extends Controller
{
    public function create(Request $request,$id){
        SolutionWorkPlan::where('voting_id',$id)->delete();
        SolutionWorkPlan::create([
            'voting_id'=>$id,
            'data'=>$request['data'],
        ]);
        return redirect()->back();
    }
    public function download($id){
        $voting=Voting::find($id);
        $solution_work_plan=SolutionWorkPlan::where('voting_id',$id)->first();

        $chairman=Voting::with('workers')->find($id)->workers->where('worker_type_id',1)->first()->name;
        $chairman_name="";
        if($chairman){
            $chairman=explode(" ",$chairman);
            for($i=1;$i<count($chairman);$i++){
                $chairman_name.=mb_substr($chairman[$i],0,1,"UTF-8").". ";
            }
            $chairman_name.=$chairman[0];
        }

        $secretary=Voting::with('workers')->find($id)->workers->where('worker_type_id',3)->first()->name;
        $secretary_name="";
        if($secretary){
            $secretary=explode(" ",$secretary);
            for($i=1;$i<count($secretary);$i++){
                $secretary_name.=mb_substr($secretary[$i],0,1,"UTF-8").". ";
            }
            $secretary_name.=$secretary[0];
        }

        $doc = new TemplateProcessor(public_path('documents/required_documents/solution_work_plan.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',Voting::with('voting_type')->find($id)->voting_type->name);
        $doc->setValue('data',$solution_work_plan->data);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);

        $doc->saveAs('Решение о плане работы.docx');
        return response()->download('Решение о плане работы.docx')->deleteFileAfterSend(true);
    }
}

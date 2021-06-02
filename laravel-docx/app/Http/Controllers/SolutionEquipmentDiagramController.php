<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolutionEquipmentDiagram;
use App\Voting;
use PhpOffice\PhpWord\TemplateProcessor;

class SolutionEquipmentDiagramController extends Controller
{
    public function create(Request $request,$id){
        SolutionEquipmentDiagram::where('voting_id',$id)->delete();
        SolutionEquipmentDiagram::create([
            'voting_id'=>$id,
            'data'=>$request['data'],
        ]);
        return redirect()->back();
    }

    public function download($id){
        $voting=Voting::find($id);
        $solution_equipment_diagram=SolutionEquipmentDiagram::where('voting_id',$id)->first();

        $chairman=Voting::with('workers')->find($id)->workers->where('worker_type_id',1)->first()->name;
        $chairman_name="";
        if($chairman){
            $chairman=explode(" ",$chairman);
            for($i=1;$i<count($chairman);$i++){
                $chairman_name.=mb_substr($chairman[$i],0,1,"UTF-8").". ";
            }
            $chairman_name.=$chairman[0];
        }
        $vice_chairman=Voting::with('workers')->find($id)->workers->where('worker_type_id',2)->first()->name;
        $vice_chairman_name="";
        if($vice_chairman){
            $vice_chairman=explode(" ",$vice_chairman);
            for($i=1;$i<count($vice_chairman);$i++){
                $vice_chairman_name.=mb_substr($vice_chairman[$i],0,1,"UTF-8").". ";
            }
            $vice_chairman_name.=$vice_chairman[0];
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

        $doc = new TemplateProcessor(public_path('documents/required_documents/solution_equipment_diagrams.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('data',$solution_equipment_diagram->data);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);
        $doc->setValue('vice_chairman',$vice_chairman_name);

        $doc->saveAs('solution_equipment_diagrams.docx');
        return response()->download('solution_equipment_diagrams.docx')->deleteFileAfterSend(true);
    }
}

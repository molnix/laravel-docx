<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Voting;
use Illuminate\Http\Request;
use App\RegisterApplicationsAppealsForVoting;
use PhpOffice\PhpWord\TemplateProcessor;

class RegisterApplicationsAppealsForVotingController extends Controller
{
    public function create(Request $request,$id){
        RegisterApplicationsAppealsForVoting::where('voting_id',$id)->delete();
        if(isset($request['voter_name'])){
            for($i=0;$i<count($request['voter_name']);$i++){
                RegisterApplicationsAppealsForVoting::create([
                    'voting_id'=>$id,
                    'voter_name'=>$request['voter_name'][$i],
                    'voter_address'=>$request['voter_address'][$i],
                    'reason_calling_commission'=>$request['reason_calling_commission'][$i],
                    'datetime_oral_appeal'=>$request['datetime_oral_appeal'][$i],
                    'datetime_written_appeal'=>$request['datetime_written_appeal'][$i],
                    'name_transmitting_appeal'=>$request['name_transmitting_appeal'][$i],
                    'address_transmitting_appeal'=>$request['address_transmitting_appeal'][$i],
                    'name_accepted_appeal'=>$request['name_accepted_appeal'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $voting=Voting::find($id);
        $registers=RegisterApplicationsAppealsForVoting::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Register_of_applications_(appeals)_for_voting_outside_the_voting_premises.docx'));

        $chairman=$voting->workers->where('worker_type_id',1)->first()->name;
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

        $values=array();
        foreach($registers as $log){
            array_push($values,array(
                'voter_name'=>$log->voter_name,
                'voter_address'=>$log->voter_address,
                'reason_calling_commission'=>$log->reason_calling_commission,
                'datetime_oral_appeal'=>$log->datetime_oral_appeal,
                'datetime_written_appeal'=>$log->datetime_written_appeal,
                'name_transmitting_appeal'=>$log->name_transmitting_appeal,
                'address_transmitting_appeal'=>$log->address_transmitting_appeal,
                'name_accepted_appeal'=>$log->name_accepted_appeal,
                'null'=>null,
            ));
        }
        $doc->cloneRowAndSetValues('voter_name', $values);
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);
        $doc->saveAs('Register_of_applications_(appeals)_for_voting_outside_the_voting_premises.docx');
        return response()->download('Register_of_applications_(appeals)_for_voting_outside_the_voting_premises.docx')->deleteFileAfterSend(true);
    }
}

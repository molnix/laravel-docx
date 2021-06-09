<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Voting;
use App\RegisterRegistrationIssuanceCertifiedCopy;

class RegisterRegistrationIssuanceCertifiedCopyController extends Controller
{
    public function create(Request $request,$id){
        RegisterRegistrationIssuanceCertifiedCopy::where('voting_id',$id)->delete();
        if(isset($request['number'])){
            for($i=0;$i<count($request['number']);$i++){
                RegisterRegistrationIssuanceCertifiedCopy::create([
                    'voting_id'=>$id,
                    'number'=>$request['number'][$i],
                    'person_accepted_protocol'=>$request['person_accepted_protocol'][$i],
                    'person_accepted_protocol_status'=>$request['person_accepted_protocol_status'][$i],
                    'personal_assured_name'=>$request['personal_assured_name'][$i],
                    'datetime_issuing'=>$request['datetime_issuing'][$i],
                    'telephone'=>$request['telephone'][$i],
                ]);
            }
        }
        return redirect()->back();
    }

    public function download($id){
        $voting=Voting::find($id);
        $registers=RegisterRegistrationIssuanceCertifiedCopy::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Register_of_registration_issuance_of_certified_copies_of_the_protocol_of_the_precinct_election_commission_on_the_results_of_voting_on_elections.docx'));

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
                'number'=>$log->number,
                'person_accepted_protocol'=>$log->person_accepted_protocol,
                'person_accepted_protocol_status'=>$log->person_accepted_protocol_status,
                'personal_assured_name'=>$log->personal_assured_name,
                'datetime_issuing'=>$log->datetime_issuing,
                'telephone'=>$log->telephone,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',$voting->voting_type->name);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);
        $doc->saveAs('Register_of_registration_issuance_of_certified_copies_of_the_protocol_of_the_precinct_election_commission_on_the_results_of_voting_on_elections.docx');
        return response()->download('Register_of_registration_issuance_of_certified_copies_of_the_protocol_of_the_precinct_election_commission_on_the_results_of_voting_on_elections.docx')->deleteFileAfterSend(true);
    }
}

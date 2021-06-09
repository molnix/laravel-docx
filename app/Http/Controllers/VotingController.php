<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voting;
Use App\Worker;
use App\VotingType;
use App\Document;
use App\ApplicationLog;
use App\ApplicationLogData;
use App\WorkPlan;
use App\SolutionEquipmentDiagram;
use App\SolutionWorkPlan;
use App\FireSafetyInstruction;
use App\ProtocolAndDecisionReviewSheet;
use App\FireSafetyInformationSheet;
use App\VotingCountVotesPersonsList;
use App\TelephoneMessageLog;
use App\RegisterApplicationsAppealsForVoting;
use App\RegisterRegistrationIssuanceCertifiedCopy;
use App\LogRegistrationDecision;
use App\LogIncomingDocument;
use App\LogOutgoingPECDocumentsRegistration;

class VotingController extends Controller
{
    public function index($id){
        $voting=Voting::find($id);
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
        $vice_chairman=Voting::with('workers')->find($id)->workers->where('worker_type_id',2)->first()->name;
        $vice_chairman_name="";
        if($vice_chairman){
            $vice_chairman=explode(" ",$vice_chairman);
            for($i=1;$i<count($vice_chairman);$i++){
                $vice_chairman_name.=mb_substr($vice_chairman[$i],0,1,"UTF-8").". ";
            }
            $vice_chairman_name.=$vice_chairman[0];
        }
        $main_workers=[$chairman_name,$vice_chairman_name,$secretary_name];

        return view('user.docx',[
            'voting_types'=>VotingType::all(),
            'voting'=>Voting::with('workers')->find($id),
            'main_workers'=>$main_workers,
            'chairman'=>Voting::with('workers')->find($id)->workers->where('worker_type_id',1)->first(),
            'vice_chairman'=>Voting::with('workers')->find($id)->workers->where('worker_type_id',2)->first(),
            'secretary'=>Voting::with('workers')->find($id)->workers->where('worker_type_id',3)->first(),
            'workers'=>Voting::with('workers')->find($id)->workers->where('worker_type_id',4),
            'selected_documents'=>Voting::with('documents')->find($id)->documents->where('first_document',0),
            'documents'=>Document::where('first_document',0)->get(),
            'application_logs'=>ApplicationLog::with('application_log_data')->where('voting_id',$id)->first(),
            'work_plan'=>WorkPlan::where('voting_id',$id)->first(),
            'solution_equipment_diagram'=>SolutionEquipmentDiagram::where('voting_id',$id)->first(),
            'solution_work_plan'=>SolutionWorkPlan::where('voting_id',$id)->first(),
            'fire_safety_instruction'=>FireSafetyInstruction::where('voting_id',$id)->first(),
            'protocol_and_decision_review_sheet_logs'=>ProtocolAndDecisionReviewSheet::where('voting_id',$id)->get(),
            'fire_safety_information_sheet_logs'=>FireSafetyInformationSheet::where('voting_id',$id)->get(),
            'voting_count_votes_persons_lists'=>VotingCountVotesPersonsList::where('voting_id',$id)->get(),
            'telephone_message_logs'=>TelephoneMessageLog::where('voting_id',$id)->get(),
            'register_applications_appeals_for_votings'=>RegisterApplicationsAppealsForVoting::where('voting_id',$id)->get(),
            'register_registration_issuance_certified_copies'=>RegisterRegistrationIssuanceCertifiedCopy::where('voting_id',$id)->get(),
            'log_of_registration_of_PEC_decisions'=>LogRegistrationDecision::where('voting_id',$id)->get(),
            'log_incoming_documents'=>LogIncomingDocument::where('voting_id',$id)->get(),
            'log_outgoing_documents'=>LogOutgoingPECDocumentsRegistration::where('voting_id',$id)->get(),
        ]);
    }

    public function create(Request $request){
        $voting_type=VotingType::where('name',$request['voting_type_name'])->first();
        if(!$voting_type){
            $voting_type=VotingType::create([
                'name'=>$request['voting_type_name'],
            ]);
        }
        $chairman=Worker::where('name',$request['chairman'])
                    ->where('workplace',$request['chairman_workplace'])
                    ->where('worker_type_id',1)->first();
        if(!$chairman){
            $chairman=Worker::create([
                'name'=>$request['chairman'],
                'workplace'=>$request['chairman_workplace'],
                'worker_type_id'=>1,
            ]);
        }
        $vice_chairman=Worker::where('name',$request['vice_chairman'])
                    ->where('workplace',$request['vice_chairman_workplace'])
                    ->where('worker_type_id',2)->first();
        if(!$vice_chairman){
            $vice_chairman=Worker::create([
                'name'=>$request['vice_chairman'],
                'workplace'=>$request['vice_chairman_workplace'],
                'worker_type_id'=>2,
            ]);
        }
        $secretary=Worker::where('name',$request['secretary'])
                    ->where('workplace',$request['secretary_workplace'])
                    ->where('worker_type_id',3)->first();
        if(!$secretary){
            $secretary=Worker::create([
                'name'=>$request['secretary'],
                'workplace'=>$request['secretary_workplace'],
                'worker_type_id'=>3,
            ]);
        }
        $voting = Voting::create([
            'plot_number'=>$request['plot_number'],
            'voting_type_id'=>$voting_type->id,
        ]);

        $application_log=ApplicationLog::create(['voting_id'=>$voting->id]);
        ApplicationLogData::create(['application_log_id'=>$application_log->id]);
        WorkPlan::create(['voting_id'=>$voting->id]);
        SolutionEquipmentDiagram::create(['voting_id'=>$voting->id]);
        SolutionWorkPlan::create(['voting_id'=>$voting->id]);
        FireSafetyInstruction::create(['voting_id'=>$voting->id]);
        TelephoneMessageLog::create(['voting_id'=>$voting->id,]);
        RegisterApplicationsAppealsForVoting::create(['voting_id'=>$voting->id,]);
        RegisterRegistrationIssuanceCertifiedCopy::create(['voting_id'=>$voting->id,]);
        LogRegistrationDecision::create(['voting_id'=>$voting->id,]);
        LogIncomingDocument::create(['voting_id'=>$voting->id,]);
        LogOutgoingPECDocumentsRegistration::create(['voting_id'=>$voting->id,]);
        
        $voting->workers()->attach([$chairman->id,$vice_chairman->id,$secretary->id]);

        if($request['workers'][0]){
            for($i=0; $i<count($request['workers']); $i++){
                if($request['workers'][$i] != null){
                    $worker=Worker::where('name',$request['workers'][$i])
                    ->where('workplace',$request['workers_workplace'][$i])
                    ->where('worker_type_id',4)->first();
                    if($worker){
                        $voting->workers()->attach($worker->id);
                    }
                    else{
                        $new_worker = Worker::create([
                            'name'=>$request['workers'][$i],
                            'workplace'=>$request['workers_workplace'][$i],
                            'worker_type_id'=>4,
                        ]);
                        $voting->workers()->attach($new_worker->id);
                    }
                }
            }
        }

        foreach($voting->workers as $worker){
            ProtocolAndDecisionReviewSheet::create([
                'voting_id'=>$voting->id,
                'name'=>$worker->name,
            ]);
            FireSafetyInformationSheet::create([
                'voting_id'=>$voting->id,
                'name'=>$worker->name,
            ]);
        }

        return redirect(route('voting_docx_page',['id'=>$voting->id]));
    }

    public function update(Request $request,$id){
        $voting=Voting::with('workers')->find($id);
        $voting->workers()->detach();

        $voting_type=VotingType::where('name',$request['voting_type_name'])->first();
        if(!$voting_type){
            $voting_type=VotingType::create([
                'name'=>$request['voting_type_name'],
            ]);
        }
        $chairman=Worker::where('name',$request['chairman'])
                    ->where('workplace',$request['chairman_workplace'])
                    ->where('worker_type_id',1)->first();
        if(!$chairman){
            $chairman=Worker::create([
                'name'=>$request['chairman'],
                'workplace'=>$request['chairman_workplace'],
                'worker_type_id'=>1,
            ]);
        }
        $vice_chairman=Worker::where('name',$request['vice_chairman'])
                    ->where('workplace',$request['vice_chairman_workplace'])
                    ->where('worker_type_id',2)->first();
        if(!$vice_chairman){
            $vice_chairman=Worker::create([
                'name'=>$request['vice_chairman'],
                'workplace'=>$request['vice_chairman_workplace'],
                'worker_type_id'=>2,
            ]);
        }
        $secretary=Worker::where('name',$request['secretary'])
                    ->where('workplace',$request['secretary_workplace'])
                    ->where('worker_type_id',3)->first();
        if(!$secretary){
            $secretary=Worker::create([
                'name'=>$request['secretary'],
                'workplace'=>$request['secretary_workplace'],
                'worker_type_id'=>3,
            ]);
        }

        $voting->update([
            'plot_number'=>$request['plot_number'],
            'voting_type_id'=>$voting_type->id,
        ]);

        $voting->workers()->attach([$chairman->id,$vice_chairman->id,$secretary->id]);

        if($request['workers'][0]){
            for($i=0; $i<count($request['workers']); $i++){
                if($request['workers'][$i] != null){
                    $worker=Worker::where('name',$request['workers'][$i])
                    ->where('workplace',$request['workers_workplace'][$i])
                    ->where('worker_type_id',4)->first();
                    if($worker){
                        $voting->workers()->attach($worker->id);
                    }
                    else{
                        $new_worker = Worker::create([
                            'name'=>$request['workers'][$i],
                            'workplace'=>$request['workers_workplace'][$i],
                            'worker_type_id'=>4,
                        ]);
                        $voting->workers()->attach($new_worker->id);
                    }
                }
            }
        }
        return redirect()->back();
    }
}

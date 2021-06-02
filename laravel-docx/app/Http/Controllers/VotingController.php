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

class VotingController extends Controller
{
    public function index($id){
        return view('user.docx',[
            'voting_types'=>VotingType::all(),
            'voting'=>Voting::with('workers')->find($id),
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

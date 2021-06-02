<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkPlan;
use App\Voting;
use PhpOffice\PhpWord\TemplateProcessor;

class WorkPlanController extends Controller
{
    public function create(Request $request,$id){
        WorkPlan::where('voting_id',$id)->delete();
        WorkPlan::create([
            'voting_id'=>$id,
            'conduct_meeting_date'=>$request['conduct_meeting_date'],
            'reception_and_registration_start_date'=>$request['reception_and_registration_start_date'],
            'reception_and_registration_end_time'=>$request['reception_and_registration_end_time'],
            'active_suffrage_start_date'=>$request['active_suffrage_start_date'],
            'active_suffrage_end_date'=>$request['active_suffrage_end_date'],
            'active_suffrage_start_time'=>$request['active_suffrage_start_time'],
            'active_suffrage_end_time'=>$request['active_suffrage_end_time'],
            'active_suffrage_open_voting_room_time'=>$request['active_suffrage_open_voting_room_time'],
            'active_suffrage_in_opening_voting_room_start_time'=>$request['active_suffrage_in_opening_voting_room_start_time'],
            'active_suffrage_in_opening_voting_room_end_time'=>$request['active_suffrage_in_opening_voting_room_end_time'],
            'active_suffrage_out_opening_voting_room_start_time'=>$request['active_suffrage_out_opening_voting_room_start_time'],
            'active_suffrage_out_opening_voting_room_end_time'=>$request['active_suffrage_out_opening_voting_room_end_time'],
            'submission_documents_date'=>$request['submission_documents_date'],
            'preparation_submission_reports_date'=>$request['preparation_submission_reports_date'],
        ]);
        return redirect()->back();
    }

    public function download($id){
        $voting=Voting::with('voting_type')->find($id);

        $work_plan = WorkPlan::where('voting_id',$id)->first();
        $doc = new TemplateProcessor(public_path('documents/required_documents/work_plan.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',$voting->voting_type->name);
        $doc->setValue('conduct_meeting_date',$work_plan->conduct_meeting_date);
        $doc->setValue('reception_and_registration_start_date',$work_plan->reception_and_registration_start_date);
        $doc->setValue('reception_and_registration_end_time',$work_plan->reception_and_registration_end_time);
        $doc->setValue('active_suffrage_start_date',$work_plan->active_suffrage_start_date);
        $doc->setValue('active_suffrage_end_date',$work_plan->active_suffrage_end_date);
        $doc->setValue('active_suffrage_start_time',$work_plan->active_suffrage_start_time);
        $doc->setValue('active_suffrage_end_time',$work_plan->active_suffrage_end_time);
        $doc->setValue('active_suffrage_open_voting_room_time',$work_plan->active_suffrage_open_voting_room_time);
        $doc->setValue('active_suffrage_in_opening_voting_room_start_time',$work_plan->active_suffrage_in_opening_voting_room_start_time);
        $doc->setValue('active_suffrage_in_opening_voting_room_end_time',$work_plan->active_suffrage_in_opening_voting_room_end_time);
        $doc->setValue('active_suffrage_out_opening_voting_room_start_time',$work_plan->active_suffrage_out_opening_voting_room_start_time);
        $doc->setValue('active_suffrage_out_opening_voting_room_end_time',$work_plan->active_suffrage_out_opening_voting_room_end_time);
        $doc->setValue('submission_documents_date',$work_plan->submission_documents_date);
        $doc->setValue('preparation_submission_reports_date',$work_plan->preparation_submission_reports_date);

        $doc->saveAs('work_plan.docx');
        return response()->download('work_plan.docx')->deleteFileAfterSend(true);
    }
}

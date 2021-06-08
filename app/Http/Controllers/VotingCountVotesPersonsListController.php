<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Voting;
use App\VotingCountVotesPersonsList;

class VotingCountVotesPersonsListController extends Controller
{
    public function create(Request $request, $id){
        VotingCountVotesPersonsList::where('voting_id',$id)->delete();
        for($i=0;$i<count($request['number']);$i++){
            VotingCountVotesPersonsList::create([
                'voting_id'=>$id,
                'number'=>$request['number'][$i],
                'name'=>$request['name'][$i],
                'status'=>$request['status'][$i],
                'represent'=>$request['represent'][$i],
                'contact'=>$request['contact'][$i],
                'hours_start'=>$request['hours_start'][$i],
                'minuts_start'=>$request['minuts_start'][$i],
                'hours_end'=>$request['hours_end'][$i],
                'minuts_end'=>$request['minuts_end'][$i],
            ]);
        }
        return redirect()->back();
    }
    public function download($id){
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

        $logs=VotingCountVotesPersonsList::where('voting_id',$id)->get();
        $values=array();
        foreach($logs as $log){
            arraY_push($values,array(
                'number'=>$log->number,
                'name'=>$log->name,
                'status'=>$log->status,
                'represent'=>$log->represent,
                'contact'=>$log->contact,
                'hours_start'=>$log->hours_start,
                'minuts_start'=>$log->minuts_start,
                'hours_end'=>$log->hours_end,
                'minuts_end'=>$log->minuts_end,
            ));
        }

        $doc = new TemplateProcessor(public_path('documents/required_documents/List_of_persons_present_during_the_voting_counting_of_votes.docx'));

        $doc->setValue('chairman',$chairman_name);
        $doc->setValue('plot',$voting->plot_number);
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs('СПИСОК лиц, присутствовавших при проведении голосования, подсчете голосов избирателей.docx');
        return response()->download('СПИСОК лиц, присутствовавших при проведении голосования, подсчете голосов избирателей.docx')->deleteFileAfterSend(true);
    }
}

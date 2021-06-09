<?php

namespace App\Http\Controllers;

use App\LogRegistrationDecision;
use App\RegisterRegistrationIssuanceCertifiedCopy;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Voting;
use App\Document;
use App\ApplicationLog;
use App\SolutionEquipmentDiagram;
use App\WorkPlan;
use App\SolutionWorkPlan;
use App\FireSafetyInstruction;
use App\ProtocolAndDecisionReviewSheet;
use App\FireSafetyInformationSheet;
use App\VotingCountVotesPersonsList;
use App\RegisterApplicationsAppealsForVoting;
use App\TelephoneMessageLog;
<<<<<<< HEAD
use App\LogIncomingDocument;
use App\LogOutgoingPECDocumentsRegistration;
=======
>>>>>>> 424386cfa9fc2585fd7fa33671fe4f14418ecbed
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use ZipArchive;

class DocumentController extends Controller
{

    public function index(){
        return view('user.documents_list',[
            'votings'=>Voting::all(),
        ]);
    }

    public function create(Request $request, $id){
        foreach($request->file('files') as $file){
            $time = str_replace('/','a',Hash::make(time()));
            $time = str_replace('.','_',$time);
            $path="documents/acts/".$time."/";
            $file->move(public_path($path), $file->getClientOriginalName());
            Document::create([
                'name'=>$file->getClientOriginalName(),
                'document_url'=>$path.$file->getClientOriginalName(),
            ]);
        }
        return redirect()->back();
    }
    public function update(Request $request, $id){
        $voting = Voting::with('documents')->find($id);
        $voting->documents()->detach();
        if($request['files'][0]){
            foreach($request['files'] as $file){
                $voting->documents()->attach($file);
            }
        }
        return redirect()->back();
    }

    public function delete($id,$document_id){
        $document = Document::with('votings')->find($document_id);
        if(isset($document->votings->pluck('id')->toArray()[0])){
            $document->votings()->detach();
        }
        $directory=explode('/',$document->document_url);
        $delete_path='';
        for($i=0;$i<count($directory)-1;$i++){
            if($i+1==count($directory)-1){
                $delete_path.=$directory[$i];
            }
            else{
                $delete_path.=$directory[$i].'/';
            }
        }
        File::deleteDirectory($delete_path);
        $document->delete();
        return redirect()->back();
    }

    public function create_all_docx($id){
        $voting=Voting::with('workers','documents')->find($id);

        $zip = new ZipArchive;
        $zip_name='download.zip';

        if($zip->open(public_path($zip_name), ZipArchive::CREATE) === TRUE){
            foreach($voting->documents as $file){
                $zip->addFile($file->document_url,'acts/'.$file->name);
            }
            $file = $this->create_application_log_document($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_solution_equipment_diagram($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_work_plan($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_solution_work_plan($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Instrukciya_o_merax_pojarnoy_bezopasnosti($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_AKT_peredachi_zayavlenuy_v_TEK($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_List_oznakomleniya_c_protokolom_and_resheniyami($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_placement_schemes($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Povestka_dnya($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Protocol_zacedaniya($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Resheniye_o_raspredelenii_obyazannostey($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Resheniye_ob_utverjdenii_rejima_vremeni_rabotey($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_List_of_persons_present_during_the_voting_counting_of_votes($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Telephone_message_log($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Statement_of_the_transfe_of_ballots_to_the_members($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Register_of_applications_appeals_for_voting_outside_the_voting_premises($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Register_registration_issuance_certified_copies($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Log_of_registration_of_PEC_decisions($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
<<<<<<< HEAD
            $file = $this->create_Log_of_incoming_documents($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
            $file = $this->create_Log_of_outgoing_PEC_documents_registration($id);
            $zip->addFile($file[1],'required_documents/'.$file[0]);
=======
>>>>>>> 424386cfa9fc2585fd7fa33671fe4f14418ecbed
            $zip->close();
        }

        return response()->download(public_path($zip_name))->deleteFileAfterSend(true);
    }

<<<<<<< HEAD
    public function create_Log_of_outgoing_PEC_documents_registration($id){
        $file = array('Журнала регистрации исходящих документов УИК.docx','download_documents/required_documents/Журнала регистрации исходящих документов УИК.docx');

        $log_outgoing_documents=LogOutgoingPECDocumentsRegistration::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Log_of_outgoing_PEC_documents_registration.docx'));

        $values=array();
        foreach($log_outgoing_documents as $log){
            array_push($values,array(
                'date'=>$log->date,
                'number'=>$log->number,
                'recipient'=>$log->recipient,
                'summary_document'=>$log->summary_document,
                'person_signed_doc'=>$log->person_signed_doc,
                'executor'=>$log->executor,
                'case'=>$log->case,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_Log_of_incoming_documents($id){
        $file = array('Журнал регистрации входящих документов.docx','download_documents/required_documents/Журнал регистрации входящих документов.docx');

        $log_incoming_documents=LogIncomingDocument::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Log_of_incoming_documents.docx'));

        $values=array();
        foreach($log_incoming_documents as $log){
            array_push($values,array(
                'date_receipt'=>$log->date_receipt,
                'number'=>$log->number,
                'correspondent'=>$log->correspondent,
                'number_doc'=>$log->number_doc,
                'date_doc'=>$log->date_doc,
                'content'=>$log->content,
                'resolution'=>$log->resolution,
                'executer'=>$log->executer,
                'term_start'=>$log->term_start,
                'term_end'=>$log->term_end,
                'mark'=>$log->mark,
                'case'=>$log->case,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs($file[1]);
        return $file;
    }

=======
>>>>>>> 424386cfa9fc2585fd7fa33671fe4f14418ecbed
    public function create_Log_of_registration_of_PEC_decisions($id){
        $file = array('Журнал регистрации решений УИК.docx','download_documents/required_documents/Журнал регистрации решений УИК.docx');

        $log_registration_decisions=LogRegistrationDecision::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Log_of_registration_of_PEC_decisions.docx'));

        $values=array();
        foreach($log_registration_decisions as $log){
            array_push($values,array(
                'date'=>$log->date,
                'number'=>$log->number,
                'name'=>$log->name,
                'number_sheets_decisions'=>$log->number_sheets_decisions,
                'number_sheets_applications'=>$log->number_sheets_applications,
                'executor'=>$log->executor,
                'note'=>$log->note,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_Register_registration_issuance_certified_copies($id){
        $file = array('РЕЕСТР регистрации выдачи заверенных копий протокола участковой избирательной комиссии об итогах голосования по выборам.docx','download_documents/required_documents/РЕЕСТР регистрации выдачи заверенных копий протокола участковой избирательной комиссии об итогах голосования по выборам.docx');

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

        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_Register_of_applications_appeals_for_voting_outside_the_voting_premises($id){
        $file = array('РЕЕСТР заявлений (обращений) о голосовании вне помещения для голосования.docx','download_documents/required_documents/РЕЕСТР заявлений (обращений) о голосовании вне помещения для голосования.docx');
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

        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_Statement_of_the_transfe_of_ballots_to_the_members($id){
        $file = array('ВЕДОМОСТЬ передачи избирательных бюллетеней членам УИК для выдачи их избирателям.docx','download_documents/required_documents/ВЕДОМОСТЬ передачи избирательных бюллетеней членам УИК для выдачи их избирателям.docx');
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
        $doc = new TemplateProcessor(public_path('documents/required_documents/Statement_of_the_transfe_of_ballots_to_the_members.docx'));
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);
        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_Telephone_message_log($id){
        $file = array('Журнал регистрации телефонограмм.docx','download_documents/required_documents/Журнал регистрации телефонограмм.docx');

        $telephone_message_log=TelephoneMessageLog::where('voting_id',$id)->get();
        $doc = new TemplateProcessor(public_path('documents/required_documents/Telephone_message_log.docx'));

        $values=array();
        foreach($telephone_message_log as $log){
            array_push($values,array(
                'number'=>$log->number,
                'date'=>$log->date,
                'person_transmitting'=>$log->person_transmitting,
                'person_transmitting_status'=>$log->person_transmitting_status,
                'person_adopted'=>$log->person_adopted,
                'person_adopted_status'=>$log->person_adopted_status,
                'content'=>$log->content,
                'note'=>$log->note,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_List_of_persons_present_during_the_voting_counting_of_votes($id){
        $file = array('СПИСОК лиц, присутствовавших при проведении голосования, подсчете голосов избирателей.docx','download_documents/required_documents/СПИСОК лиц, присутствовавших при проведении голосования, подсчете голосов избирателей.docx');
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

        $doc->saveAs($file[1]);
        return $file;
    }

    public function create_application_log_document($id){
        $file = array('ЖУРНАЛ заявлений.doc','download_documents/required_documents/ЖУРНАЛ заявлений.doc');
        $voting=Voting::find($id);
        $application_logs=ApplicationLog::with('application_log_data')->where('voting_id',$id)->first();
        $doc = new TemplateProcessor(public_path('documents/required_documents/application_log.docx'));
        $doc->setValue('main_date',$application_logs->date);
        $doc->setValue('for_question',$application_logs->for_question);
        $doc->setValue('plot',$voting->plot_number);
        $values=array();
        foreach($application_logs->application_log_data as $application_log){
            arraY_push($values,array(
                'number'=>$application_log->number,
                'date'=>$application_log->date,
                'time'=>$application_log->time,
                'participant_name'=>$application_log->participant_name,
                'adress'=>$application_log->adress,
                'person_accepted_name'=>$application_log->person_accepted_name,
                'null'=>null,
                'note'=>$application_log->note,
            ));
        }
        $doc->cloneRowAndSetValues('number', $values);

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_solution_equipment_diagram($id){
        $file = array('Решение о схеме размещения оборудования.docx','download_documents/required_documents/Решение о схеме размещения оборудования.docx');

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

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_work_plan($id){
        $file = array('План работы УИК в период проведения выборов.docx','download_documents/required_documents/План работы УИК в период проведения выборов.docx');

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

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_solution_work_plan($id){
        $file = array('Решение о плане работы.docx','download_documents/required_documents/Решение о плане работы.docx');

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

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_Instrukciya_o_merax_pojarnoy_bezopasnosti($id){
        $file = array('Инструкция о мерах пожарной безопасности.docx','download_documents/required_documents/Инструкция о мерах пожарной безопасности.docx');

        $voting=Voting::find($id);
        $fire_safety_instruction=FireSafetyInstruction::where('voting_id',$id)->first();

        $doc = new TemplateProcessor(public_path('documents/required_documents/Instrukciya_o_merax_pojarnoy_bezopasnosti.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('man_fire_safety',$fire_safety_instruction->man_fire_safety);
        $doc->setValue('allowed_number',$fire_safety_instruction->allowed_number);
        $doc->setValue('man_fire_safety2',$fire_safety_instruction->man_fire_safety2);
        $doc->setValue('man_message_fire',$fire_safety_instruction->man_message_fire);
        $doc->setValue('address_object',$fire_safety_instruction->address_object);
        $doc->setValue('man_evacuation',$fire_safety_instruction->man_evacuation);
        $doc->setValue('man_fire_protection_check',$fire_safety_instruction->man_fire_protection_check);
        $doc->setValue('man_power_outage',$fire_safety_instruction->man_power_outage);
        $doc->setValue('place_power_outage',$fire_safety_instruction->place_power_outage);
        $doc->setValue('man_work_stoppage',$fire_safety_instruction->man_work_stoppage);
        $doc->setValue('man_guide',$fire_safety_instruction->man_guide);
        $doc->setValue('man_evacuation2',$fire_safety_instruction->man_evacuation2);
        $doc->setValue('man_meeting',$fire_safety_instruction->man_meeting);
        $doc->setValue('man_guide2',$fire_safety_instruction->man_guide2);

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti($id){
        $file = array('Лист ознакомления с правилами пожарной безопасности.docx','download_documents/required_documents/Лист ознакомления с правилами пожарной безопасности.docx');
        $logs=FireSafetyInformationSheet::where('voting_id',$id)->get();

        $doc = new TemplateProcessor(public_path('documents/required_documents/List_oznakomleniya_c_pravilami_pojarnoi_bezopacnocti.docx'));

        $values=array();
        foreach($logs as $log){
            arraY_push($values,array(
                'name'=>$log->name,
            ));
        }
        $doc->cloneRowAndSetValues('name', $values);

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_AKT_peredachi_zayavlenuy_v_TEK($id){
        $file = array('АКТ передачи заявлений в ТИК.docx','download_documents/required_documents/АКТ передачи заявлений в ТИК.docx');

        $doc = new TemplateProcessor(public_path('documents/required_documents/AKT_peredachi_zayavlenuy_v_TEK.docx'));

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_List_oznakomleniya_c_protokolom_and_resheniyami($id){
        $file = array('Лист ознакомления с протоколом и решениями.docx','download_documents/required_documents/Лист ознакомления с протоколом и решениями.docx');

        $voting=Voting::find($id);
        $logs=ProtocolAndDecisionReviewSheet::where('voting_id',$id)->get();

        $doc = new TemplateProcessor(public_path('documents/required_documents/List_oznakomleniya_c_protokolom_and_resheniyami.docx'));

        $doc->setValue('plot',$voting->plot_number);
        $values=array();
        foreach($logs as $log){
            arraY_push($values,array(
                'name'=>$log->name,
            ));
        }
        $doc->cloneRowAndSetValues('name', $values);

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_placement_schemes($id){
        $file = array('Схемы размещения.docx','download_documents/required_documents/Схемы размещения.docx');
        $voting=Voting::find($id);
        $doc = new TemplateProcessor(public_path('documents/required_documents/placement_schemes.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_Povestka_dnya($id){
        $file = array('Повестка дня.docx','download_documents/required_documents/Повестка дня.docx');

        $voting=Voting::find($id);
        $secretary = Voting::with('workers')->find($id)->workers->where('worker_type_id',3)->first()->name;

        $doc = new TemplateProcessor(public_path('documents/required_documents/Povestka_dnya.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',Voting::with('voting_type')->find($id)->voting_type->name);
        $doc->setValue('secretary',$secretary);
        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_Protocol_zacedaniya($id){
        $file = array('Протокол заседания.docx','download_documents/required_documents/Протокол заседания.docx');

        $voting=Voting::find($id);

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

        $doc = new TemplateProcessor(public_path('documents/required_documents/Protocol_zacedaniya.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',Voting::with('voting_type')->find($id)->voting_type->name);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);
        $doc->setValue('vice_chairman',$vice_chairman_name);
        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_Resheniye_o_raspredelenii_obyazannostey($id){
        $file = array('Решение о распределении обязанностей.docx','download_documents/required_documents/Решение о распределении обязанностей.docx');

        $voting=Voting::find($id);

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

        $doc = new TemplateProcessor(public_path('documents/required_documents/Resheniye_o_raspredelenii_obyazannostey.docx'));
        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',Voting::with('voting_type')->find($id)->voting_type->name);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);

        $doc->saveAs($file[1]);
        return $file;
    }
    public function create_Resheniye_ob_utverjdenii_rejima_vremeni_rabotey($id){
        $file = array('Решение об утверждении режима (времени) работы.docx','download_documents/required_documents/Решение об утверждении режима (времени) работы.docx');

        $voting=Voting::find($id);

        $doc = new TemplateProcessor(public_path('documents/required_documents/Resheniye_ob_utverjdenii_rejima_vremeni_rabotey.docx'));

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

        $doc->setValue('plot',$voting->plot_number);
        $doc->setValue('voting_type',Voting::with('voting_type')->find($id)->voting_type->name);
        $doc->setValue('secretary',$secretary_name);
        $doc->setValue('chairman',$chairman_name);
        $doc->saveAs($file[1]);
        return $file;
    }
}

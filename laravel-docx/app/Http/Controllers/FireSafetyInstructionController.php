<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voting;
use App\FireSafetyInstruction;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class FireSafetyInstructionController extends Controller
{
    public function create(Request $request,$id){
        FireSafetyInstruction::where('voting_id',$id)->delete();
        FireSafetyInstruction::create([
            'voting_id'=>$id,
            'man_fire_safety'=>$request['man_fire_safety'],
            'allowed_number'=>$request['allowed_number'],
            'man_fire_safety2'=>$request['man_fire_safety2'],
            'man_message_fire'=>$request['man_message_fire'],
            'address_object'=>$request['address_object'],
            'man_evacuation'=>$request['man_evacuation'],
            'man_fire_protection_check'=>$request['man_fire_protection_check'],
            'man_power_outage'=>$request['man_power_outage'],
            'place_power_outage'=>$request['place_power_outage'],
            'man_work_stoppage'=>$request['man_work_stoppage'],
            'man_guide'=>$request['man_guide'],
            'man_evacuation2'=>$request['man_evacuation2'],
            'man_meeting'=>$request['man_meeting'],
            'man_guide2'=>$request['man_guide2'],
        ]);

        return redirect()->back();
    }

    public function download($id){
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

        $doc->saveAs('Instrukciya_o_merax_pojarnoy_bezopasnosti.docx');
        return response()->download('Instrukciya_o_merax_pojarnoy_bezopasnosti.docx')->deleteFileAfterSend(true);
    }
}

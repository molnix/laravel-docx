<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ApplicationLogController;
use App\Http\Controllers\WorkPlanController;
use App\Http\Controllers\SolutionEquipmentDiagramController;
use App\Http\Controllers\SolutionWorkPlanController;
use App\Http\Controllers\FireSafetyInstructionController;
use App\Http\Controllers\ProtocolAndDecisionReviewSheetController;
use App\Http\Controllers\FireSafetyInformationSheetController;
use App\Http\Controllers\VotingCountVotesPersonsListController;
use App\Http\Controllers\TelephoneMessageLogController;
use App\Http\Controllers\RegisterApplicationsAppealsForVotingController;
use App\Http\Controllers\RegisterRegistrationIssuanceCertifiedCopyController;
use App\Http\Controllers\LogRegistrationDecisionController;
<<<<<<< HEAD
use App\Http\Controllers\LogIncomingDocumentController;
use App\Http\Controllers\LogOutgoingPECDocumentsRegistrationController;
=======
<<<<<<< HEAD
use App\Http\Controllers\LogIncomingDocumentController;
use App\Http\Controllers\LogOutgoingPECDocumentsRegistrationController;
=======
>>>>>>> 424386cfa9fc2585fd7fa33671fe4f14418ecbed
>>>>>>> 9f4a4572bc5a7fa36639a31fc7fc3e560b1dad4b
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/password/create', [UserController::class, 'show_password_create'])->name('password_create_page');
Route::post('/password/create', [UserController::class, 'password_create']);

Route::get('/', [LoginController::class, 'index'])->name('login_page');
Route::post('/', [LoginController::class, 'login']);

Route::middleware('auth')->group(function (){
    Route::get('/profile/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile/documents', [DocumentController::class, 'index'])->name('documents_page');

    Route::get('/profile', [UserController::class, 'index'])->name('profile_page');
    Route::post('/profile/create/voting',[VotingController::class,'create'])->name('create_voting');
    Route::middleware('check.voting')->group(function(){
        Route::get('/profile/voting/{id}/docx',[VotingController::class,'index'])->name('voting_docx_page');
        Route::post('/profile/voting/{id}/docx',[DocumentController::class,'create_all_docx']);
        Route::post('/profile/update/voting/{id}',[VotingController::class,'update'])->name('update_voting');
        Route::post('/profile/voting/{id}/create/documents',[DocumentController::class, 'create'])->name('create_new_documents');
        Route::post('/profile/voting/{id}/update/documents/',[DocumentController::class, 'update'])->name('update_documents');
        Route::get('/profile/voting/{id}/delete/documents/{document_id}',[DocumentController::class, 'delete'])->name('delete_document');

        Route::post('/profile/voting/{id}/create/application_log',[ApplicationLogController::class,'create'])->name('create_application_log');
        Route::get('/profile/voting/{id}/download/application_log',[ApplicationLogController::class,'download'])->name('download_application_log');

        Route::post('/profile/voting/{id}/create/work_plan',[WorkPlanController::class,'create'])->name('create_work_plan');
        Route::get('/profile/voting/{id}/download/work_plan',[WorkPlanController::class,'download'])->name('download_work_plan');

        Route::post('/profile/voting/{id}/create/solution_equipment_diagram',[SolutionEquipmentDiagramController::class,'create'])->name('create_solution_equipment_diagram');
        Route::get('/profile/voting/{id}/download/solution_equipment_diagram',[SolutionEquipmentDiagramController::class,'download'])->name('download_solution_equipment_diagram');

        Route::post('/profile/voting/{id}/create/solution_work_plan',[SolutionWorkPlanController::class,'create'])->name('create_solution_work_plan');
        Route::get('/profile/voting/{id}/download/solution_work_plan',[SolutionWorkPlanController::class,'download'])->name('download_solution_work_plan');

        Route::post('/profile/voting/{id}/create/fire_safety_instruction',[FireSafetyInstructionController::class,'create'])->name('create_fire_safety_instruction');
        Route::get('/profile/voting/{id}/download/fire_safety_instruction',[FireSafetyInstructionController::class,'download'])->name('download_fire_safety_instruction');

        Route::post('/profile/voting/{id}/create/fire_safety_information_sheet',[FireSafetyInformationSheetController::class,'create'])->name('create_fire_safety_information_sheet');
        Route::get('/profile/voting/{id}/download/fire_safety_information_sheet',[FireSafetyInformationSheetController::class,'download'])->name('download_fire_safety_information_sheet');

        Route::post('/profile/voting/{id}/create/protocol_and_decision_review_sheet',[ProtocolAndDecisionReviewSheetController::class,'create'])->name('create_protocol_and_decision_review_sheet');
        Route::get('/profile/voting/{id}/download/protocol_and_decision_review_sheet',[ProtocolAndDecisionReviewSheetController::class,'download'])->name('download_protocol_and_decision_review_sheet');

        Route::post('/profile/voting/{id}/create/voting_count_votes_persons_list',[VotingCountVotesPersonsListController::class,'create'])->name('create_voting_count_votes_persons_list');
        Route::get('/profile/voting/{id}/download/voting_count_votes_persons_list',[VotingCountVotesPersonsListController::class,'download'])->name('download_voting_count_votes_persons_list');

        Route::post('/profile/voting/{id}/create/Telephone_message_log',[TelephoneMessageLogController::class,'create'])->name('create_telephone_message_log');
        Route::get('/profile/voting/{id}/download/Telephone_message_log',[TelephoneMessageLogController::class,'download'])->name('download_telephone_message_log');

        Route::post('/profile/voting/{id}/create/register_applications_appeals_for_voting',[RegisterApplicationsAppealsForVotingController::class,'create'])->name('create_register_applications_appeals_for_voting');
        Route::get('/profile/voting/{id}/download/register_applications_appeals_for_voting',[RegisterApplicationsAppealsForVotingController::class,'download'])->name('download_register_applications_appeals_for_voting');

        Route::post('/profile/voting/{id}/create/register_registration_issuance_certified_copies',[RegisterRegistrationIssuanceCertifiedCopyController::class,'create'])->name('create_register_registration_issuance_certified_copies');
        Route::get('/profile/voting/{id}/download/register_registration_issuance_certified_copies',[RegisterRegistrationIssuanceCertifiedCopyController::class,'download'])->name('download_register_registration_issuance_certified_copies');

        Route::post('/profile/voting/{id}/create/Log_of_registration_of_PEC_decisions',[LogRegistrationDecisionController::class,'create'])->name('create_Log_of_registration_of_PEC_decisions');
        Route::get('/profile/voting/{id}/download/Log_of_registration_of_PEC_decisions',[LogRegistrationDecisionController::class,'download'])->name('download_Log_of_registration_of_PEC_decisions');

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9f4a4572bc5a7fa36639a31fc7fc3e560b1dad4b
        Route::post('/profile/voting/{id}/create/Log_of_incoming_documents',[LogIncomingDocumentController::class,'create'])->name('create_Log_of_incoming_documents');
        Route::get('/profile/voting/{id}/download/Log_of_incoming_documents',[LogIncomingDocumentController::class,'download'])->name('download_Log_of_incoming_documents');

        Route::post('/profile/voting/{id}/create/Log_of_outgoing_PEC_documents_registration',[LogOutgoingPECDocumentsRegistrationController::class,'create'])->name('create_Log_of_outgoing_PEC_documents_registration');
        Route::get('/profile/voting/{id}/download/Log_of_outgoing_PEC_documents_registration',[LogOutgoingPECDocumentsRegistrationController::class,'download'])->name('download_Log_of_outgoing_PEC_documents_registration');

<<<<<<< HEAD
=======
=======
>>>>>>> 424386cfa9fc2585fd7fa33671fe4f14418ecbed
>>>>>>> 9f4a4572bc5a7fa36639a31fc7fc3e560b1dad4b
    });

});

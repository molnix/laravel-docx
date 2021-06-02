<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPlan extends Model
{
    protected $fillable=[
        'voting_id',
        'conduct_meeting_date',
        'reception_and_registration_start_date',
        'reception_and_registration_end_time',
        'active_suffrage_start_date',
        'active_suffrage_end_date',
        'active_suffrage_start_time',
        'active_suffrage_end_time',
        'active_suffrage_open_voting_room_time',
        'active_suffrage_in_opening_voting_room_start_time',
        'active_suffrage_in_opening_voting_room_end_time',
        'active_suffrage_out_opening_voting_room_start_time',
        'active_suffrage_out_opening_voting_room_end_time',
        'submission_documents_date',
        'preparation_submission_reports_date',
    ];
}

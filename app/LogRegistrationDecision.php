<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogRegistrationDecision extends Model
{
    protected $fillable=[
        'voting_id',
        'date',
        'number',
        'name',
        'number_sheets_decisions',
        'number_sheets_applications',
        'executor',
        'note',
    ];
}

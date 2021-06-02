<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationLogData extends Model
{
    protected $table='application_log_data';
    protected $fillable=[
        'application_log_id',
        'number',
        'date',
        'time',
        'participant_name',
        'adress',
        'person_accepted_name',
        'note',
    ];
}

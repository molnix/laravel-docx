<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterRegistrationIssuanceCertifiedCopy extends Model
{
    protected $fillable=[
        'voting_id',
        'number',
        'person_accepted_protocol',
        'person_accepted_protocol_status',
        'personal_assured_name',
        'datetime_issuing',
        'telephone',
    ];
}

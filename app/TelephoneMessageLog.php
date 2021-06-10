<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelephoneMessageLog extends Model
{
    protected $fillable=[
        'voting_id',
        'number',
        'date',
        'person_transmitting',
        'person_transmitting_status',
        'person_adopted',
        'person_adopted_status',
        'content',
        'note',
    ];
}

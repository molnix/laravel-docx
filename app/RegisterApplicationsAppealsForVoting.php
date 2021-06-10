<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterApplicationsAppealsForVoting extends Model
{
    protected $fillable=[
        'voting_id',
        'voter_name',
        'voter_address',
        'reason_calling_commission',
        'datetime_oral_appeal',
        'datetime_written_appeal',
        'name_transmitting_appeal',
        'address_transmitting_appeal',
        'name_accepted_appeal',
    ];
}

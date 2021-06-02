<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotingCountVotesPersonsList extends Model
{
    protected $fillable=[
        'voting_id',
        'number',
        'name',
        'status',
        'represent',
        'contact',
        'hours_start',
        'minuts_start',
        'hours_end',
        'minuts_end',
    ];
}

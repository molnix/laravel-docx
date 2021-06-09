<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogIncomingDocument extends Model
{
    protected $fillable=[
        'voting_id',
        'date_receipt',
        'number',
        'correspondent',
        'number_doc',
        'date_doc',
        'content',
        'resolution',
        'executer',
        'term_start',
        'term_end',
        'mark',
        'case',
    ];
}

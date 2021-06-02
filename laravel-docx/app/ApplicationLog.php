<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    protected $fillable=[
        'voting_id',
        'date',
        'for_question',
    ];

    public function application_log_data(){
        return $this->hasMany('App\ApplicationLogData');
    }
}

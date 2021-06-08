<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $fillable = [
        'plot_number',
        'voting_type_id',
    ];

    public function voting_type(){
        return $this->belongsTo('App\VotingType');
    }
    public function workers(){
        return $this->belongsToMany('App\Worker');
    }
    public function documents(){
        return $this->belongsToMany('App\Document','voting_document');
    }
}

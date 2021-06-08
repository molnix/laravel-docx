<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=[
        'name',
        'document_url',
        'first_document',
    ];
    public function votings(){
        return $this->belongsToMany('App\Voting','voting_document');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireSafetyInformationSheet extends Model
{
    protected $fillable=[
        'voting_id',
        'name',
    ];
    public $timestamps=false;
}

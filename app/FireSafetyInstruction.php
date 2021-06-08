<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireSafetyInstruction extends Model
{
    protected $fillable=[
        'voting_id',
        'man_fire_safety',
        'allowed_number',
        'man_fire_safety2',
        'man_message_fire',
        'address_object',
        'man_evacuation',
        'man_fire_protection_check',
        'man_power_outage',
        'place_power_outage',
        'man_work_stoppage',
        'man_guide',
        'man_evacuation2',
        'man_meeting',
        'man_guide2',
    ];
}

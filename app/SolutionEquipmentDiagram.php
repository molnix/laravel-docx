<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolutionEquipmentDiagram extends Model
{
    protected $table='solution_equipment_diagrams';
    protected $fillable=[
        'voting_id',
        'data',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedulings extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'start_time',
        'end_time',
        'details',
        'type',
        'type_description',
        'status',
        'work_assignment_id',
        'earning_id',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeLogs extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'break_in',
        'break_out',
        'ot_in',
        'ot_out',
        'total_hours',
        'break_hours',
        'ot_hours',
        'late_hours',
        'undertime',
        'type',
        'status',
        'schedule_status',
        'workstation_id',
        'created_by',
        'updated_by',
    ];
}

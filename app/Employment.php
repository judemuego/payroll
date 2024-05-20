<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'classes_id',
        'position_id',
        'department_id',
        'payroll_calendar_id',
        'employment_date',
        'tax_rate',
        'created_by',
        'updated_by'
    ];
    
}

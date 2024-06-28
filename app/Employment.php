<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employment extends Model
{
    use SoftDeletes;

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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'leave_name',
        'units',
        'normal_entitlement',
        'paid_leave',
        'show_on_payslip',
        'workstation_id',
        'workstation_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}

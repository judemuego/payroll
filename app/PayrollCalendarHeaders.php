<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollCalendarHeaders extends Model
{
    protected $fillable = [
        'workstation_id',
        'name',
        'calendar_type',
        'frequency',
        'set_as_default',
        'status',
        'created_by',
        'updated_by'
    ];
    
    public function details() {
        return $this->hasOne(PayrollCalendarDetails::class, 'payroll_calendar_header_id', 'id');
    }
}

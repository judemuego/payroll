<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollSummary extends Model
{
    protected $fillable = [
        "sequence_no",
        "schedule_type",
        "period_start",
        "payroll_period",
        "pay_date",
        "status",
        'workstation_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function calendar()
    {
        return $this->belongsTo(PayrollCalendar::class, 'schedule_type');
    }

    public function details()
    {
        return $this->hasMany(PayrollSummaryDetails::class, 'sequence_no', 'sequence_no');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollCalendarDetails extends Model
{
    protected $fillable = [
        'payroll_calendar_header_id',
        'start_date',
        'first_payment',
        'start_of_week',
        'end_of_week'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollCalendar extends Model
{
    protected $fillable = [
        'title',
        'type',
        'start_date',
        'end_date',
        'payment_date',
        'start_day',
        'end_day',
        'payment_day',
        'set_as_default',
        'status',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

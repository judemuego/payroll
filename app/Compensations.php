<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compensations extends Model
{
    protected $fillable = [
        'annual_salary',
        'monthly_salary',
        'semi_monthly_salary',
        'weekly_salary',
        'daily_salary',
        'hourly_salary',
        'tax',
        'government_mandated_benefits',
        'other_company_benefits',
        'employee_id',
        'created_by',
        'updated_by'
    ];
}

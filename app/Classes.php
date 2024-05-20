<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'id',
        'description',
        'payment_schedule',
        'tax_applicable',
        'government_mandated_benefits',
        'other_company_benefits',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'multiplier',
        'type',
        'taxable',
        'status',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

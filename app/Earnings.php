<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Earnings extends Model
{
    use SoftDeletes;

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

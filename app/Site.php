<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'project_name',
        'location',
        'person_in_charge',
        'workstation_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}

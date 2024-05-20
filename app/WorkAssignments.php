<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkAssignments extends Model
{
    protected $fillable = [
        'title',
        'workstation_id',
        'status',
        'created_by',
        'updated_by'
    ];
}

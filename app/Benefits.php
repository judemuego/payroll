<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    protected $fillable = [
        'id',
        'benefits',
        'description',
        'account',
        'type',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

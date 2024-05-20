<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $fillable = [
        'id',
        'description',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

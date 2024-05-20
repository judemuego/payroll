<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $fillable = [
        'id',
        'description',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departments extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'description',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Benefits extends Model
{
    use SoftDeletes;

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

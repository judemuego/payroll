<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SSS extends Model
{
    protected $fillable = [
        "range_1",
        "range_2",
        "regular_s",
        "wisp",
        "er",
        "ee",
        "ecc",
        "wisp_er",
        "wisp_ee",
        "workstation_id",
        "created_by",
        "updated_by"
    ];

    protected $table = 'sss';
}

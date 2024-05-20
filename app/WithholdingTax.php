<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithholdingTax extends Model
{
    protected $fillable = [
        "frequency",
        "range_from",
        "range_to",
        "fix_tax",
        "rate_on_excess",
        "status",
        "workstation_id",
        "created_by",
        "updated_by"
    ];
}

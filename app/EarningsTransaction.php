<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarningsTransaction extends Model
{
    protected $fillable = [
        'employee_id',
        'sequence_no',
        'earning_id',
        'rate',
        'hours',
        'total',
        'status',
        'workstation_id',
        'created_by',
        'updated_by'
    ];

    public function earning() {
        return $this->hasOne(Earnings::class, 'id', 'earning_id');
    }
}

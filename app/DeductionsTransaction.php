<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeductionsTransaction extends Model
{
    protected $fillable = [
        'employee_id',
        'sequence_no',
        'deduction_id',
        'rate',
        'hours',
        'total',
        'status',
        'workstation_id',
        'created_by',
        'updated_by'
    ];

    public function deduction() {
        return $this->hasOne(Deductions::class, 'id', 'deduction_id');
    }
}

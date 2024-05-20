<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    protected $fillable = [
        'leave_type',
        'total_hours',
        'employee_id',
        'created_by',
        'updated_by'
    ];

    public function leave_type() {
        return $this->hasOne(LeaveType::class, 'id', 'leave_type');
    }
}

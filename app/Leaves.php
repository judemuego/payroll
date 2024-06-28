<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaves extends Model
{
    use SoftDeletes;

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

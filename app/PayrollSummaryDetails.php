<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollSummaryDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "employee_id",
        "sequence_no",
        "gross_earnings",
        "sss",
        "pagibig",
        "philhealth",
        "tax",
        "net_pay",
        "status",
        "workstation_id",
        "created_by",
        "updated_by",
    ];

    public function employee() {
        return $this->hasOne(EmployeeInformation::class, 'id', 'employee_id');
    }
}

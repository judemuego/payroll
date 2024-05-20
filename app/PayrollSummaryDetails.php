<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollSummaryDetails extends Model
{
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

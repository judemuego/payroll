<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeBenefits extends Model
{
    protected $fillable = [
        'benefits_id',
        'employee_id',
        'amount',
        'type',
        'created_by',
        'updated_by'
    ];
    
    public function benefits() {
        return $this->hasOne(Benefits::class, 'id', 'benefits_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'contact_no',
        'contact_person',
        'address',
        'tin_no',
        'payment_terms',
        'bank_name',
        'bank_account',
        'workstation_id',
        'created_by',
        'updated_by'
    ];
}

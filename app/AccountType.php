<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category',
        'account_type',
        'workstation_id',
        'created_by',
        'updated_by'
    ];

    public function account_type()
    {
        return $this->belongsTo(AccountType::class, 'account_type');
    }
}

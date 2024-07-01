<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'delivery_date',
        'site_id',
        'po_date',
        'contact_no',
        'reference',
        'terms',
        'due_date',
        'order_no',
        'tax_type',
        'subtotal',
        'total_with_tax',
        'delivery_instruction',
        'status',
        'prepared_by',
        'prepared_at',
        'reviewed_by',
        'reviewed_at',
        'approved_by',
        'approved_at',
        'received_by',
        'received_at',
        'workstation_id',
        'created_by',
        'updated_by'
    ];

    public function details() {
        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_order_id', 'id');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function site() {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function prepared_by() {
        return $this->belongsTo(EmployeeInformation::class, 'prepared_by');
    }

    public function reviewed_by() {
        return $this->belongsTo(EmployeeInformation::class, 'reviewed_by');
    }

    public function approved_by() {
        return $this->belongsTo(EmployeeInformation::class, 'approved_by');
    }

    public function received_by() {
        return $this->belongsTo(EmployeeInformation::class, 'received_by');
    }
}

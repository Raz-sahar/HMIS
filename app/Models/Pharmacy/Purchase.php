<?php

namespace App\Models\Pharmacy;

use App\Livewire\Pharmacy\PurchaseDetail;
use App\Livewire\Pharmacy\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'purchase_no',
        'purchase_date',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_active',
        'is_delete',
        'total_amount',
        'total_discount',
        'total_quantity',
    ];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}

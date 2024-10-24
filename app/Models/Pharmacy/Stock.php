<?php

namespace App\Models\Pharmacy;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'batch_no',
        'quantity_in_stock',
        'minimum_required_quantity',
        'reorder_level',
        'expiry_date',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_active',
        'is_delete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

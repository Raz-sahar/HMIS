<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_active',
        'is_delete'
    ];
}

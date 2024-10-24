<?php

namespace App\Models\General;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'department_head',
        'location',
        'phone_number',
        'email',
        'is_active',
        'is_delete',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function Department_Head()
    {
        return $this->belongsTo(User::class, 'department_head');
    }

    public function Created_By()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function Updated_By()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function Deleted_By()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

}

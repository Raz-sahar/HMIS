<?php

namespace App\Models\Reception;

use App\Livewire\General\Department;
use App\Livewire\General\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'fees_type',
        'amount',
        'currency',
        'description',
        'employee_id',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_active',
        'is_delete'
    ];

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'employee_id');
    // }

    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'department_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

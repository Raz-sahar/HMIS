<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Department extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'image', 'created_by'];

    // Relationship to the user who created the department
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

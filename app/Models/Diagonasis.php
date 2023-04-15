<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagonasis extends Model
{
    use HasFactory;

    public function department_all()
    {
        return $this->belongsTo(Department::class, 'department' , 'id');
    }
} 

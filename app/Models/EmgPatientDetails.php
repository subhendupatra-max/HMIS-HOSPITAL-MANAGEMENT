<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class EmgPatientDetails extends Model
{
    use HasFactory;

    public function patient_department_details()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
}

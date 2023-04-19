<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\User;

class OpdVisitDetails extends Model
{
    use HasFactory;
    public function department_details()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'cons_doctor', 'id');
    }
    public function referer()
    {
        return $this->belongsTo(User::class, 'refference', 'id');
    }
    public function GeneratedBy()
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }
    
    public function PatientPhisicalCondition()
    {
        return $this->belongsTo(PatientPhysicalDetails::class, 'opd_visit_details_id', 'id');
    }

}

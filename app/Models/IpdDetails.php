<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class IpdDetails extends Model
{
    use HasFactory;

    public function bed_types()
    {
        return $this->belongsTo(BedType::class, 'bedType_id', 'id');
    }
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function generated_by_details()
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }
    public function referral_details()
    {
        return $this->belongsTo(Referral::class, 'refference', 'id');
    }
    public function doctor_details()
    {
        return $this->belongsTo(User::class, 'cons_doctor', 'id');
    }
    public function department_details()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function bed_details()
    {
        return $this->belongsTo(Bed::class, 'bed', 'id');
    }
    public function ward_details()
    {
        return $this->belongsTo(Ward::class, 'bed_ward_id', 'id');
    }
    public function unit_details()
    {
        return $this->belongsTo(BedUnit::class, 'bed_unit_id', 'id');
    }
    public function patient_bed_history()
    {
        return $this->belongsTo(PatientBedHistory::class, 'id', 'ipd_id');
    }
   
}

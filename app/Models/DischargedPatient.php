<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class DischargedPatient extends Model
{
    use HasFactory;

    public function ipd_details()
    {
       return  $this->belongsTo(IpdDetails::class, 'ipd_id', 'id');
    }

    public function physical_condition_details()
    {
        return $this->belongsTo(IpdPatientPhysicalDetail::class, 'ipd_id', 'ipd_id');
    }

    public function patient_details()
    {
        return  $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagonasis::class, 'icd_code', 'id');
    }
    public function doctor_details()
    {
        return  $this->belongsTo(User::class, 'doctor_name', 'id');
    }
    public function diagnosis_details()
    {
        return $this->belongsTo(Diagonasis::class, 'icd_code', 'id');
    }

}

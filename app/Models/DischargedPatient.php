<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargedPatient extends Model
{
    use HasFactory;

    public function ipd_details()
    {
        $this->belongsTo(IpdDetails::class, 'ipd_id', 'id');
    }

    public function physical_condition_details()
    {
        $this->belongsTo(IpdPatientPhysicalDetail::class, 'ipd_id', 'ipd_id');
    }

    public function patient_details()
    {
        $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function diagnosis()
    {
        $this->belongsTo(Diagonasis::class, 'icd_code', 'id');
    }
}

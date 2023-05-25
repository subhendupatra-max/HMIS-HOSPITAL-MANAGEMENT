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

    public function patient_details()
    {
        $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}

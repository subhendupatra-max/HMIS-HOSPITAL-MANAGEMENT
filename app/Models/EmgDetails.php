<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmgPatientDetails;
use App\Models\Patient;

class EmgDetails extends Model
{
    use HasFactory;
    public function patient_details()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function all_emg_visit_details()
    {
        return $this->belongsTo(EmgPatientDetails::class, 'id', 'emg_details_id');
    }
    public function generator_details()
    {
        return $this->belongsTo(User::class, 'generate_by', 'id');
    }

    // public function patient_state()
    // {
    //     return $this->belongsTo(State::class, 'state', 'id');
    // }
}

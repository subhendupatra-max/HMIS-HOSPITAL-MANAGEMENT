<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\OpdVisitDetails;
use App\Models\User;

class OpdDetails extends Model
{
    use HasFactory;
    
    public function patient_details()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function latest_opd_visit_details_for_patient()
    {
        return $this->belongsTo(OpdVisitDetails::class,'id','opd_details_id')->latest();
    }
    public function generator_details()
    {
        return $this->belongsTo(User::class,'generate_by','id');
    }

    public function patient_state()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
    public function doctor_details()
    {
        return $this->belongsTo(User::class,'cons_doctor','id');
    }
    public function department_details()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function tpa_details()
    {
        return $this->belongsTo(Diagonasis::class,'tpa_organization','id');
    }
    public function billing_details()
    {
        return $this->belongsTo(Billing::class,'id','opd_id');
    }
   
}

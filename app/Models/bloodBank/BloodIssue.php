<?php

namespace App\Models\bloodBank;

use App\Models\BloodGroup;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BloodIssue extends Model
{
    use HasFactory;

    public function blood_group_details()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group', 'id');
    }

    public function patient_details()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctor_details()
    {
        return $this->belongsTo(User::class, 'doctor', 'id');
    }
   


}

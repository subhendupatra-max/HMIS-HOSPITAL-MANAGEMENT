<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Patient;

class Appointment extends Model
{
    use HasFactory;

    public function patient_details()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function doctor_details()
    {
        return $this->belongsTo(User::class,'doctor','id');
    }
}

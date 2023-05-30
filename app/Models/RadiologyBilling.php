<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class RadiologyBilling extends Model
{
    use HasFactory;
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
}

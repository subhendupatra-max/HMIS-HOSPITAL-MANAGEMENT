<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommissionPayment extends Model
{
    use HasFactory;
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class,'patient_details','id');
    }
    public function referral_details()
    {
        return $this->belongsTo(Referral::class,'reference_id','id');
    }
}

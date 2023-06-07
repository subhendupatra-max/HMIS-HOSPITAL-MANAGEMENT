<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class MedicineBilling extends Model
{
    use HasFactory;
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function generated_by_details()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function medicine_billing_details()
    {
        return $this->belongsTo(MedicineBillingDetails::class,'id','medicine_billing_id');
    }
}

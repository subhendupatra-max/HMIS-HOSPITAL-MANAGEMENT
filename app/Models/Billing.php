<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    public function created_details()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function patient_details()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function discount_details()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

    public function opd_details()
    {
        return $this->belongsTo(OpdDetails::class, 'opd_id', 'id');
    }

    public function bill_details()
    {
        return $this->belongsTo(BillDetails::class,'id','bill_id');
    }
}

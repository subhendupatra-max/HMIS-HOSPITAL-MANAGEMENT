<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MedicineBilling;

class MedicineBillingDetails extends Model
{
    use HasFactory;



    public function medicine_bill()
    {
        return $this->belongsTo(MedicineBilling::class, 'medicine_billing_id', 'id');
    }
//
    public function medicine_names()
    {
        return $this->belongsTo(Medicine::class, 'medicine_name', 'id');
    }

    public function unit_name()
    {
        return $this->belongsTo(Medicine::class, 'unit_id', 'id');
    }
}

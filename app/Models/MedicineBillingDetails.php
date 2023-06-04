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
}

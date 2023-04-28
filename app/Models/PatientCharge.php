<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCharge extends Model
{
    use HasFactory;

    public function charge_details()
    {
        return $this->belongsTo(Charge::class, 'charge_name', 'id');
    }
}

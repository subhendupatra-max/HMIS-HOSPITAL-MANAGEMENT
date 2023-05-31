<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EPrescription extends Model
{
    use HasFactory;

    public function eprescription_details()
    {
        return $this->belongsTo(EPrescriptionMedicine::class, 'id', 'e_prescriptions_id');
    }
}

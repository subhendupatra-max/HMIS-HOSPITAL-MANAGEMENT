<?php

namespace App\Models\bloodBank;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    use HasFactory;

    public function getDonorDetails()
    {
        return $this->belongsTo(BloodDonor::class, 'blood_donor_id', 'id');
    }
}

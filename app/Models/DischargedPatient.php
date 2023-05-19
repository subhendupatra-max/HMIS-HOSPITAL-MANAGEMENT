<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargedPatient extends Model
{
    use HasFactory;

    public function getIpdDetails()
    {
        $this->belongsTo(IpdDetails::class, 'ipd_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChargesCatagory;
use App\Models\ChargesSubCatagory;

class AmbulanceCall extends Model
{
    use HasFactory;

    public function ambulance_details()
    {
        return $this->belongsTo(Ambulance::class,'vehicle_model','id');
    }
    
}

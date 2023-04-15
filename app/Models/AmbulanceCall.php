<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChargesCatagory;
use App\Models\ChargesSubCatagory;

class AmbulanceCall extends Model
{
    use HasFactory;

    public function catagory()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charge_category' ,'id');
    }

    public function subCatagory()
    {
        return $this->belongsTo(ChargesSubCatagory::class , 'charge_sub_category' , 'id');
    }
    
}

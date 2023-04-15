<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    public function fetch_doctor_name()
    {
        return $this->belongsTo(User::class, 'doctor', 'id');
    }
    
    public function fetch_catagorys_name()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charge_category', 'id');
    }

    public function fetch_sub_catagorys_name()
    {
        return $this->belongsTo(ChargesSubCatagory::class, 'charge_sub_category', 'id');
    }

    public function fetch_charges_name()
    {
        return $this->belongsTo(Charge::class, 'charge', 'id');
    }


}

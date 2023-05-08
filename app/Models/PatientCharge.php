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
    public function generated_by_details()
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }
    public function charges_category_details()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charge_category', 'id');
    }
    public function charges_sub_category_details()
    {
        return $this->belongsTo(ChargesSubCatagory::class, 'charge_sub_category', 'id');
    }
    public function charges_name_details()
    {
        return $this->belongsTo(Charge::class, 'charge_name', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyTest extends Model
{
    use HasFactory;
    public function radiology_catagory()
    {
        return $this->belongsTo(RadiologyCatagory::class, 'catagory_id', 'id');
    }

    public function charges_catagory()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charge_category', 'id');
    }
    public function charges_sub_catagory()
    {
        return $this->belongsTo(ChargesSubCatagory::class, 'charge_sub_category', 'id');
    }
    public function charges()
    {
        return $this->belongsTo(Charge::class, 'charge', 'id');
    }

    public function test_details()
    {
        return $this->belongsTo(RadiologyTestDetails::class, 'id', 'radiology_test_id');
    }
}

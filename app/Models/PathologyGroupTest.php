<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyGroupTest extends Model
{
    use HasFactory;
    public function pathologyTestDetails()
    {
        return $this->belongsTo(PathologyGroupTestDetails::class,'id' , 'pathology_group_test_id');
    }
    public function pathology_catagory()
    {
        return $this->belongsTo(PathologyCatagory::class, 'catagory_id' , 'id');
    }

    public function charges_catagory()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charge_category' , 'id');
    }
    public function charges_sub_catagory()
    {
        return $this->belongsTo(ChargesSubCatagory::class, 'charge_sub_category' , 'id');
    }
    public function charges()
    {
        return $this->belongsTo(Charge::class, 'charge' , 'id');
    }

}

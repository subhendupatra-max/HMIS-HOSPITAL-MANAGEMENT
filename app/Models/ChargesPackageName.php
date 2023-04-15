<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargesPackageName extends Model
{
    use HasFactory;

    public function chargesPackageCatagoryName()
    {
        return $this->belongsTo(ChargesPackageCatagory::class, 'charge_package_catagory_id', 'id');
    }

    public function chargesPackageSubCatagoryName()
    {
        return $this->belongsTo(ChargesPackageSubCatagory::class, 'charge_package_sub_catagory_id', 'id');
    }

   
}

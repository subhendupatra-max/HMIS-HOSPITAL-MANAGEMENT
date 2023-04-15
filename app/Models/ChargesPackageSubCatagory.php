<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargesPackageSubCatagory extends Model
{
    use HasFactory;

    public function chargesPackageCatagoryName()
    {
        return $this->belongsTo(chargesPackageCatagory::class, 'charges_package_catagory_id' , 'id');
    }
}

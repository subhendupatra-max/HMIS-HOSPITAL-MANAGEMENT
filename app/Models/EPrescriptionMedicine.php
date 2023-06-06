<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MedicineCatagory;
use App\Models\Medicine;

class EPrescriptionMedicine extends Model
{
    use HasFactory;

    public function medicine_details()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id','id');
    }

     public function catagory_name()
    {
        return $this->belongsTo(MedicineCatagory::class, 'medicine_category_id' , 'id');
    }

}

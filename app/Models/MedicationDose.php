<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationDose extends Model
{
    use HasFactory;

    public function medicine_catagory_name()
    {
        return $this->belongsTo(MedicineCatagory::class, 'medicine_catagory_id','id');
    }

    public function all_medicine_name()
    {
        return $this->belongsTo(Medicine::class,'medicine_name','id');
    }

    public function dosage_name()
    {
        return $this->belongsTo(Dosage::class,'medicine_catagory_id','medicine_catagory_id');
    }
}

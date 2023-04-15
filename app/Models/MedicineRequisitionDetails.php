<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRequisitionDetails extends Model
{
    use HasFactory;

    public function fetch_medicine_catagory()
    {
        return $this->belongsTo(MedicineCatagory::class,'medicine_catagory','id');
    }

    public function fetch_medicine_unit()
    {
        return $this->belongsTo(MedicineUnit::class,'medicine_unit','id');
    }

    public function fetch_medicine_name()
    {
        return $this->belongsTo(Medicine::class,'medicine_name','id');
    }
}

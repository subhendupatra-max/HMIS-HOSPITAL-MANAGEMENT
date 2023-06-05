<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine;
use App\Models\MedicineCatagory;

class MedicineStock extends Model
{
    use HasFactory;
    public function medicine_unit()
    {
        return $this->belongsTo(MedicineUnit::class, 'unit', 'id');
    }

    public function catagory_name()
    {
        return $this->belongsTo(MedicineCatagory::class, 'catagory', 'id');
    }

    public function medicine_store_room()
    {
        return $this->belongsTo(MedicineStoreRoom::class, 'stored_room', 'id');
    }

    public function medicine_names()
    {
        return $this->belongsTo(Medicine::class, 'medicine', 'id');
    }

    public function medicine_catagory_details()
    {
        return $this->belongsTo(MedicineCatagory::class, 'catagory', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRNDetail extends Model
{
    use HasFactory;

    public function fetch_medicine_catagory()
    {
        return $this->belongsTo(MedicineCatagory::class, 'catagory_id', 'id');
    }

    public function fetch_medicine_unit()
    {
        return $this->belongsTo(MedicineUnit::class, 'unit_id', 'id');
    }

    public function fetch_medicine_name()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
}

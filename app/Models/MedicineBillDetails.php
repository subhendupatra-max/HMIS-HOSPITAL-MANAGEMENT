<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineBillDetails extends Model
{
    use HasFactory;
    public function medicine_catagory_details()
    {
        return $this->belongsTo(MedicineCatagory::class, 'medicine_category', 'id');
    }
        public function medicine_details()
    {
        return $this->belongsTo(Medicine::class, 'medicine_name', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{
    use HasFactory;
    public function medicine_unit()
    {
        return $this->belongsTo(MedicineUnit::class, 'unit', 'id');
    }

}

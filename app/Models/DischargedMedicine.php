<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargedMedicine extends Model
{
    use HasFactory;

    public function medicine_details()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id','id');
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    public function catagory_name()
    {
        return $this->belongsTo(MedicineCatagory::class, 'medicine_catagory' , 'id');
    }

    public function unit_name()
    {
        return $this->belongsTo(MedicineCatagory::class, 'medicine_catagory' , 'id');
    }
}

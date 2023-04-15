<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBedHistory extends Model
{
    use HasFactory;
    public function department_details()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function bed_details()
    {
        return $this->belongsTo(Bed::class,'bed_id','id');
    }
    public function ward_details()
    {
        return $this->belongsTo(Ward::class,'bed_ward_id','id');
    }
    public function unit_details()
    {
        return $this->belongsTo(BedUnit::class,'bed_unit_id','id');
    }
}

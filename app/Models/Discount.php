<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    public function request_by_details()
    {
        return $this->belongsTo(User::class,'requested_by','id');
    }
    public function patient_details()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function discount_details()
    {
        return $this->hasMany(DiscountDetails::class,'id','discount_id');
    }
}

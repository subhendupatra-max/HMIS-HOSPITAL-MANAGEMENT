<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RadiologyUnit;

class RadiologyParameter extends Model
{
    use HasFactory;

    public function unitName()
    {
        return $this->belongsTo(RadiologyUnit::class,'unit_id' , 'id');
      
    }
}

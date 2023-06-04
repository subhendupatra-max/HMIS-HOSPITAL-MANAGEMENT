<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathReport extends Model
{
    use HasFactory;
    public function ipd_details()
    {
        return $this->belongsTo(IpdDetails::class,'ipd_id','id');
    }
}

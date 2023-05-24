<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodComponentIssue extends Model
{
    use HasFactory;

    public function blood_group_details()
    {
        return $this->belongsTo(BloodGroup::class,'blood_group','id');
    }
}

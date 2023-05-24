<?php

namespace App\Models\bloodBank;

use App\Models\BloodGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodIssue extends Model
{
    use HasFactory;

    public function blood_group_details()
    {
        return $this->belongsTo(BloodGroup::class,'blood_group','id');
    }
}

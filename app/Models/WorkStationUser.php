<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkStationUser extends Model
{
    use HasFactory;
    public function staff_details()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
}

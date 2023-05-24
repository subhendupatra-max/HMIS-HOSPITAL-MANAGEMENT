<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationBooking extends Model
{
    use HasFactory;

    public function doctor_detail()
    {
        return $this->belongsTo(User::class, 'consultant_doctor', 'id');
    }
}

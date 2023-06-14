<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseReference extends Model
{
    use HasFactory;

    public function medicine_billings()
    {
        return $this->belongsTo(MedicineBilling::class, 'id', 'case_id');
    }
}

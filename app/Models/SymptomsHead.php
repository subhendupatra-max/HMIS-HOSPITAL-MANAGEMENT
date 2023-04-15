<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SymptomsType;

class SymptomsHead extends Model
{
    use HasFactory;

    public function symptomsTypeall()
    {
        return $this->belongsTo(SymptomsType::class, 'symptoms_type', 'id');
    }
    
}

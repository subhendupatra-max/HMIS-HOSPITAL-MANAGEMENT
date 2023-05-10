<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestWithParameterInRadiology extends Model
{
    use HasFactory;
    public function test_parameter_name()
    {
        return $this->belongsTo(RadiologyParameter::class, 'radiology_parameter_id', 'id');
    }

    public function test_parameter_n()
    {
        return $this->hasMany(RadiologyParameter::class, 'radiology_parameter_id', 'id');
    }
}

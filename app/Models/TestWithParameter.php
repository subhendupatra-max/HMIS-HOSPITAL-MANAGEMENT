<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestWithParameter extends Model
{
    use HasFactory;
    public function test_parameter_name()
    {
        return $this->belongsTo(PathologyParameter::class, 'pathology_parameter_id','id');
    }

    public function test_parameter_n()
    {
        return $this->hasMany(PathologyParameter::class, 'pathology_parameter_id','id');
    }

}

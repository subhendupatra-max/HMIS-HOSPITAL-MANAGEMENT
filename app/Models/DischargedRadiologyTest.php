<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RadiologyTest;

class DischargedRadiologyTest extends Model
{
    use HasFactory;
    public function test_details_radiology()
    {
        return $this->belongsTo(RadiologyTest::class,'test_id','id');
    }
}

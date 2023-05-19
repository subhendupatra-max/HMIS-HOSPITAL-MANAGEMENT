<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyPatientTest extends Model
{
    use HasFactory;
    public function all_patient_details()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function generator_details()
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }
    public function test_details()
    {
        return $this->belongsTo(RadiologyTest::class, 'test_id', 'id');
    }
}

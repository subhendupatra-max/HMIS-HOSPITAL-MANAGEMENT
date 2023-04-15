<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyGroupTestDetails extends Model
{
    use HasFactory;
    public function testName()
    {
        return $this->belongsTo(PathologyTest::class,'pathology_test_id' , 'id');

    }
}

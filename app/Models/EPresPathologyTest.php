<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EPresPathologyTest extends Model
{
    use HasFactory;

    public function test_details()
    {
        return $this->belongsTo(PathologyTest::class,'test_id','id');
    }
}

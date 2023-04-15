<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyTestMaster extends Model
{
    use HasFactory;
    public function pathology_catagory()
    {
        return $this->belongsTo(PathologyCatagory::class, 'catagory_id' , 'id');
    }
    public function test_parameter()
    {
        return $this->belongsTo(PathologyTestMasterDetails::class, 'id','pathology_test_master_id');
    }
}

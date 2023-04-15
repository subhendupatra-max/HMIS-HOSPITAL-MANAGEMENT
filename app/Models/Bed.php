<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    public function bed_type()
    {
        return $this->belongsTo(BedType::class, 'bedType_id', 'id');
    }

    public function bed_unit()
    {
        return $this->belongsTo(BedUnit::class, 'bedUnit_id', 'id');
    }

    public function bed_group()
    {
        return $this->belongsTo(BedGroup::class, 'bedGroup_id', 'id');
    }

    public function bed_department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function bed_ward()
    {
        return $this->belongsTo(Ward::class, 'bedWard_id', 'id');
    }


}

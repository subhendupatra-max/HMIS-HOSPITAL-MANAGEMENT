<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationTheatre extends Model
{
    use HasFactory;

    public function operation_catagory()
    {
        return $this->belongsTo(OperationCatagory::class, 'operation_catagory' ,'id');
    }

    public function operation_departments()
    {
        return $this->belongsTo(Department::class, 'operation_department' ,'id');
    }

  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'operation_department', 'id');
    }

    public function operation_catagory_id()
    {
        return $this->belongsTo(OperationCatagory::class, 'operation_catagory', 'id');
    }

}

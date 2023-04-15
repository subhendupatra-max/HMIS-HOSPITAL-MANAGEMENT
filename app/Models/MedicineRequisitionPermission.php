<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MedicineRequisitionPermission extends Model
{
    use HasFactory;

    public function permission_user_details()
    {
        return $this->belongsTo(User::class,'user_id' , 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPermission extends Model
{
    use HasFactory;

    public function permisison_users_vendor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

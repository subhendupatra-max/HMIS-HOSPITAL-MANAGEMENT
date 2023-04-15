<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseNote extends Model
{
    use HasFactory;

    public function nurseNames()
    {
        return $this->belongsTo(User::class, 'nurse', 'id');
    }
}

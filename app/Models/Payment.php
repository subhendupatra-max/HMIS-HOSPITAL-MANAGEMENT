<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function generated_by()
    {
        return $this->belongsTo(User::class, 'payment_recived_by', 'id');
    }
}

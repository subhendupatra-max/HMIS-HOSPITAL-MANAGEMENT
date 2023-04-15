<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogDetails extends Model
{
    use HasFactory;

    protected $fillable = [
    'log_details',
    'user_id',
    'ip_address'
    ];
}

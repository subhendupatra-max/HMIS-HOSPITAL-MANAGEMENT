<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveApplication extends Model
{
    use HasFactory;

    public function user_details()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function permission_details()
    {
        return $this->belongsTo(LeavePermission::class, 'leave_id', 'id');
    }

    protected $fillable = [
        'leave_id',
        'user_id',
        'approve_date',
        'leave_status',
        'comment',
       
    ];
}

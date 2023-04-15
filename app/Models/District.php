<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['state_id','name','status'];
    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

}

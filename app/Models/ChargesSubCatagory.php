<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargesSubCatagory extends Model
{
    use HasFactory;


    public function charges_catagory()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charges_catagories_id', 'id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'charges_catagory_id',
        'charges_sub_catagory_id',
        'charges_unit_id',
        'charges_name',
        'date',
        'description',
    ];


    public function charges_catagory()
    {
        return $this->belongsTo(ChargesCatagory::class, 'charges_catagory_id', 'id');
    }

    public function charges_sub_catagory()
    {
        return $this->belongsTo(ChargesSubCatagory::class, 'charges_sub_catagory_id', 'id');
    }

}

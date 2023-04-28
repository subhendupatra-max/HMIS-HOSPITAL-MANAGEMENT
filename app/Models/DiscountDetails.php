<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountDetails extends Model
{
    use HasFactory;
    public function bill()
    {
        return $this->belongsTo(Billing::class,'bill_id','id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class,'discount_id','id');
    }
}

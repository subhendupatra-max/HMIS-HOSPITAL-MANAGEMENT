<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorQuatation extends Model
{
    use HasFactory;

    public function sl_vendors_join()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}

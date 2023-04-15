<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InventoryVendor;

class InventoryVendorQuatation extends Model
{
    use HasFactory;

    public function sl_vendors_join()
    {
        return $this->belongsTo(InventoryVendor::class,'vendor_id','id');
    }
}

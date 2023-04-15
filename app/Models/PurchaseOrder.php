<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    public function get_user_details()
    {
        return $this->belongsTo(User::class, 'generated_by','id');
    }
   
    public function get_store_details()
    {
        return $this->belongsTo(MedicineStoreRoom::class, 'store_room_id','id');
    }

    public function get_wroking_status_details()
    {
        return $this->belongsTo(WorkingStatus::class, 'status','id');
    }

    public function get_vendor_details()
    {
        return $this->belongsTo(Vendor::class, 'vendor','id');
    }



}

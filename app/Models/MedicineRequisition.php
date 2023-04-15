<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRequisition extends Model
{
    use HasFactory;

    public function generate_by_name()
    {
        return $this->belongsTo(User::class, 'genarated_by', 'id');
    }

    public function working_status()
    {
        return $this->belongsTo(WorkingStatus::class, 'status', 'id');
    }

    public function store_room()
    {
        return $this->belongsTo(MedicineStoreRoom::class, 'store_room_id', 'id');
    }

    public function vendor_quatation_details()
    {
        return $this->belongsTo(VendorQuatation::class, 'id', 'req_id');
    }
}

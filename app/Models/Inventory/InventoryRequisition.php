<?php

namespace App\Models\Inventory;

use App\Models\ItemStoreRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkingStatus;
use App\Models\InventoryVendorQuatation;
use App\Models\User;

class InventoryRequisition extends Model
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
        return $this->belongsTo(ItemStoreRoom::class, 'stock_room', 'id');
    }

    public function vendor_quatation_details()
    {
        return $this->belongsTo(InventoryVendorQuatation::class, 'id', 'req_id');
    }
}

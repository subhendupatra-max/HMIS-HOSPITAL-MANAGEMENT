<?php

namespace App\Models\Inventory;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemStoreRoom;
use App\Models\WorkingStatus;

class InventoryPurchaseOrder extends Model
{
    use HasFactory;

    public function user_details()
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }

    public function store_room()
    {
        return $this->belongsTo(ItemStoreRoom::class, 'stock_room_id', 'id');
    }

    public function working_status()
    {
        return $this->belongsTo(WorkingStatus::class, 'status', 'id');
    }
}

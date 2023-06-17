<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemStoreRoom;

class InventoryGRN extends Model
{
    use HasFactory;

    public function store_room()
    {
        return $this->belongsTo(ItemStoreRoom::class, 'workshop_id', 'id');
    }
}

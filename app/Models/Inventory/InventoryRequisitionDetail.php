<?php

namespace App\Models\Inventory;

use App\Models\ItemCatagory;
use App\Models\ItemUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryRequisitionDetail extends Model
{
    use HasFactory;

    public function fetch_item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function fetch_item_unit()
    {
        return $this->belongsTo(ItemUnit::class, 'unit_id', 'id');
    }

   
}

<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class InventoryItemIssueDetail extends Model
{
    use HasFactory;

    public function item_details()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}

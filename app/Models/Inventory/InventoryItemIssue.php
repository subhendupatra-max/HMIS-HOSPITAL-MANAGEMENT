<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\InventoryItemIssueDetail;
use App\Models\ItemStoreRoom;
use App\Models\ItemUnit;
use App\Models\User;

class InventoryItemIssue extends Model
{
    use HasFactory;

    public function issue_details()
    {
        return $this->belongsTo(InventoryItemIssueDetail::class, 'id', 'issue_id');
    }

    public function store_room_details()
    {
        return $this->belongsTo(ItemStoreRoom::class, 'stock_room_id', 'id');
    }

    public function issue_to_details()
    {
        return $this->belongsTo(User::class, 'issued_to', 'id');
    }

    public function issue_by_details()
    {
        return $this->belongsTo(User::class, 'issued_by', 'id');
    }

    public function generated_by_details()
    {
        return $this->belongsTo(User::class, 'issued_by', 'id');
    }

    public function unit_details()
    {
        return $this->belongsTo(ItemUnit::class, 'unit_id', 'id');
    }



}

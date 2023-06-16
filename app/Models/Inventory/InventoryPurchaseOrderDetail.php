<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPurchaseOrderDetail extends Model
{
    use HasFactory;
    public function generate_by_name()
    {
        return $this->belongsTo(User::class, 'genarated_by', 'id');
    }
}

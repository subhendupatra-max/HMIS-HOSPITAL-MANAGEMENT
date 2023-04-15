<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;

    public function store_room_details()
    {
        return $this->belongsTo(MedicineStoreRoom::class, 'storeroom_id', 'id');
    }

    public function fetch_user_details()
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }

    public function fetch_vendor_details()
    {
        return $this->belongsTo(Vendor::class, 'vendor', 'id');
    }
}

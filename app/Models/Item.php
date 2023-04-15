<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['is_active'];

    public function fetch_catagory_name()
    {
        return $this->belongsTo(ItemCatagory::class, 'item_catagory_id', 'id');
    }

    public function fetch_brand_name()
    {
        return $this->belongsTo(ItemBrand::class, 'brand_id', 'id');
    }

    public function fetch_manufacture_name()
    {
        return $this->belongsTo(Manufacture::class, 'manufacture', 'id');
    }

    public function fetch_itemTypes_details()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id', 'id');
    }

 
}

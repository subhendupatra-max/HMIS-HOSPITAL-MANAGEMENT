<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemStockController extends Controller
{
    public function item_stock_details()
    {
        $item = Item::all();

        return view('Inventory.item-stock-details', compact('item'));
    }
}

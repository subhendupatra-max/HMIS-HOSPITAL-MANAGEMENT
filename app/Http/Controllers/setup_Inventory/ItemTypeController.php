<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
    public function item_item_type_details()
    {
        $itemType = ItemType::all();

        return view('setup.Inventory.item-type.item-type-details', compact('itemType'));
    }

    public function save_item_item_type(Request $request)
    {
        $request->validate([
            'item_type_name' => 'required',
        ]);

        $status = ItemType::Insert([
            'item_type_name' => $request->item_type_name,
        ]);

        if ($status) {
            return back()->with('success', "Item Type Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_item_item_type($id)
    {
        $id = base64_decode($id);
        $itemType = ItemType::all();
        $editItemType = ItemType::where('id', $id)->first();

        return view('setup.Inventory.item-type.edit-item-type', compact('itemType', 'editItemType'));
    }

    public function update_item_item_type(Request $request)
    {
        $request->validate([
            'item_type_name' => 'required',
        ]);

        $itemType = ItemType::find($request->id);
        $itemType->item_type_name = $request->item_type_name;
        $status = $itemType->save();

        if ($status) {
            return redirect()->route('add-inventory-item-type')->with('success', " Item Type Updated Successfully");
        } else {
            return redirect()->route('add-inventory-item-type')->with('error', "Something Went Wrong");
        }
    }

    public function delete_item_item_type($id)
    {
        $id = base64_decode($id);
        ItemType::find($id)->delete();

        return back()->with('success', "Item Type Deleted Successfully");
    }
}

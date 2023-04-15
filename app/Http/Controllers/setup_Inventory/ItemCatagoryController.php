<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCatagory;

class ItemCatagoryController extends Controller
{
    public function item_catagory_details()
    {
        $item_catagory = ItemCatagory::all();

        return view('setup.Inventory.item-catagory.item-catagory-details', compact('item_catagory'));
    }

    public function save_item_catagory(Request $request)
    {
        $request->validate([
            'item_catagory_name' => 'required',
        ]);

        $status = ItemCatagory::Insert([
            'item_catagory_name' => $request->item_catagory_name,
        ]);

        if ($status) {
            return back()->with('success', " Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_item_catagory($id)
    {
        $id = base64_decode($id);
        $item_catagory = ItemCatagory::all();
        $editItemCatagory = ItemCatagory::where('id', $id)->first();

        return view('setup.Inventory.item-catagory.edit-item-catagory', compact('item_catagory', 'editItemCatagory'));
    }

    public function update_item_catagory(Request $request)
    {
        $request->validate([
            'item_catagory_name' => 'required',
        ]);

        $item_catagory = ItemCatagory::find($request->id);
        $item_catagory->item_catagory_name = $request->item_catagory_name;
        $status = $item_catagory->save();

        if ($status) {
            return redirect()->route('add-inventory-item-catagory')->with('success', " Catagory Updated Successfully");
        } else {
            return redirect()->route('add-inventory-item-catagory')->with('error', "Something Went Wrong");
        }
    }

    public function delete_item_catagory($id)
    {
        $id = base64_decode($id);
        ItemCatagory::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

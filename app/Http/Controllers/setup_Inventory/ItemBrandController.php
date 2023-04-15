<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use App\Models\ItemBrand;
use Illuminate\Http\Request;

class ItemBrandController extends Controller
{
    public function item_brand_details()
    {
        $item_brand = ItemBrand::all();

        return view('setup.Inventory.item-brand.item-brand-details', compact('item_brand'));
    }

    public function save_item_brand(Request $request)
    {
        $request->validate([
            'item_brand_name' => 'required',
        ]);

        $status = ItemBrand::Insert([
            'item_brand_name' => $request->item_brand_name,
        ]);

        if ($status) {
            return back()->with('success', " Brand Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }


    public function edit_item_brand($id)
    {
        $id = base64_decode($id);
        $item_brand = ItemBrand::all();
        $editItemBrand = ItemBrand::where('id', $id)->first();

        return view('setup.Inventory.item-brand.edit-item-brand', compact('item_brand', 'editItemBrand'));
    }

    public function update_item_brand(Request $request)
    {
        $request->validate([
            'item_brand_name' => 'required',
        ]);

        $item_brand = ItemBrand::find($request->id);
        $item_brand->item_brand_name = $request->item_brand_name;
        $status = $item_brand->save();

        if ($status) {
            return redirect()->route('add-inventory-item-brand')->with('success', " Brand Updated Successfully");
        } else {
            return redirect()->route('add-inventory-item-brand')->with('error', "Something Went Wrong");
        }
    }

    public function delete_item_brand($id)
    {
        $id = base64_decode($id);
        ItemBrand::find($id)->delete();

        return back()->with('success', "Brand Deleted Successfully");
    }
}

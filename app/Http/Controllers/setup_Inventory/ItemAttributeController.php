<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemAttribute;
use Illuminate\Support\Facades\Auth;

class ItemAttributeController extends Controller
{
    public function item_attribute_listing()
    {
        $itemAttribute = ItemAttribute::all();

        return view('setup.Inventory.item-attribute.item-attribute-listing', compact('itemAttribute'));
    }

    public function add_item_attribute()
    {
        return view('setup.Inventory.item-attribute.add-item-attribute');
    }

    public function save_item_attribute(Request $req)
    {
        $req->validate([
            'attribute_name'       => 'required',
            'attribute_label_name' => 'required',

        ]);
        $item = new ItemAttribute();
        $item->attribute_name       = $req->attribute_name;
        $item->attribute_label_name = $req->attribute_label_name;
        $item->created_by           = Auth::user()->id;
        $status = $item->save();

        if ($status) {
            return redirect()->route('inventory-item-attribute')->with('success', "Item Attribute Added Successfully");
        } else {
            return redirect()->route('inventory-item-attribute')->with('error', "Something Went Wrong");
        }
    }

    public function edit_item_attribute($id)
    {
        $id = base64_decode($id);
        $itemAttribute = ItemAttribute::all();
        $editItemAttribute = ItemAttribute::where('id', $id)->first();

        return view('setup.Inventory.item-attribute.edit-item-attribute', compact('itemAttribute', 'editItemAttribute'));
    }

    public function update_item_attribute(Request $req)
    {
        $req->validate([
            'attribute_name' => 'required',
            'attribute_label_name' => 'required',

        ]);
        $item = ItemAttribute::find($req->id);
        $item->attribute_name = $req->attribute_name;
        $item->attribute_label_name = $req->attribute_label_name;
        $item->updated_by = Auth::user()->id;
        $status = $item->save();

        if ($status) {
            return redirect()->route('inventory-item-attribute')->with('success', "Item Attribute Updated Successfully");
        } else {
            return redirect()->route('inventory-item-attribute')->with('error', "Something Went Wrong");
        }
    }

    public function delete_item_attribute($id)
    {
        $id = base64_decode($id);
        ItemAttribute::find($id)->delete();

        return back()->with('success', "Item Attribute Deleted Successfully");
    }
}

<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemUnit;

class ItemUnitController extends Controller
{
    public function item_unit_details()
    {
        $allItemUnit = ItemUnit::all();

        return view('setup.Inventory.item-unit.item-unit-details', compact('allItemUnit'));
    }

    public function save_item_unit(Request $request)
    {
        $validator = $request->validate([
            'item_unit' => 'required|unique:item_units,units,{{$request->item_unit}}',
            'base_val' => 'nullable',
            'operation_value' => "required_with:base_val",
            'operator' => 'required_with:base_val',
        ]);

        if ($request->base_val != "") {

            $itemUnit = new ItemUnit();
            $itemUnit->units            = $request->item_unit;
            $itemUnit->base_unit        = $request->base_val;
            $itemUnit->operation_value  = $request->operation_value;
            $itemUnit->operator         = $request->operator;
            $itemUnitStatus = $itemUnit->save();
        } else {

            $itemUnit = new ItemUnit();
            $itemUnit->units            = $request->item_unit;
            $itemUnitStatus = $itemUnit->save();
        }

        if ($itemUnitStatus) {
            return back()->with('success', "Item Unit Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_item_unit($id)
    {
        $allItemUnit = ItemUnit::all();
        $itemUnit = ItemUnit::find(base64_decode($id));
        return view('setup.Inventory.item-unit.edit-item-unit', compact('allItemUnit', 'itemUnit'));
    }

    public function update_item_unit(Request $request)
    {

        // $validator = $request->validate([
        //     'item_unit' => 'required',
        //     'item_unit_id' => 'required',
        //     'base_val' => 'required',
        //     'operator' => 'required',
        //     'operation_value' => 'required',
        // ]);


        $validator = $request->validate([
            'item_unit' => 'required',
        
        ]);

        $unit = ItemUnit::where('id', $request->item_unit_id)->first();
        $unit->units            = $request->item_unit;
        $unit->base_unit        = $request->base_val;
        $unit->operation_value  = $request->operation_value;
        $unit->operator         = $request->operator;
        $unit->update();

        return redirect()->route('add-inventory-item-unit')->with('success', 'Unit Updated Successfully');
    }

    public function delete_item_unit(Request $request)
    {
        $unit = ItemUnit::find($request->item_unit);
        $unit->delete();
        return redirect()->route('add-inventory-item-unit')->with('success', 'Item Unit Removed Successfully');
    }
}

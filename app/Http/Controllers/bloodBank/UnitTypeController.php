<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bloodBank\UnitType;

class UnitTypeController extends Controller
{
    public function add_blood_unit_type()
    {
        $bloodUnitType = UnitType::all();

        return view('setup.blood-bank.blood-unit-type.blood-unit-type-listing', compact('bloodUnitType'));
    }

    public function save_blood_unit_type(Request $request)
    {
        $validate = $request->validate([
            'blood_unit_types' => 'required',
        ]);

        $bloodUnitType = new UnitType();
        $bloodUnitType->blood_unit_types = $request->blood_unit_types;
        $status = $bloodUnitType->save();

        if ($status) {
            return back()->with('success', "Unit Type Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_blood_unit_type($id, Request $request)
    {
        $id = base64_decode($id);
        $bloodUnitType = UnitType::all();
        $editUnitType = UnitType::find($id);

        return view('setup.blood-bank.blood-unit-type.edit-blood-unit-type', compact('bloodUnitType', 'editUnitType'));
    }

    public function update_blood_unit_type(Request $request)
    {
        $validate = $request->validate([
            'blood_unit_types' => 'required',
        ]);

        $bloodUnitType = UnitType::find($request->id);
        $bloodUnitType->blood_unit_types = $request->blood_unit_types;
        $status = $bloodUnitType->save();

        if ($status) {
            return redirect()->route('add-blood-unit-type')->with('success', 'UnitType Updated Sucessfully');
        } else {
            return redirect()->route('add-blood-unit-type')->with('error', "Something Went Wrong");
        }
    }

    public function delete_blood_unit_type($id)
    {
        $id = base64_decode($id);
        UnitType::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Unit Type Deleted Sucessfully');
    }
}

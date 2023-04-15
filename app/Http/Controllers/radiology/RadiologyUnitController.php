<?php

namespace App\Http\Controllers\radiology;

use App\Http\Controllers\Controller;
use App\Models\RadiologyUnit;
use Illuminate\Http\Request;

class RadiologyUnitController extends Controller
{
    public function unit_details()
    {
        $unit = RadiologyUnit::all();

        return view('setup.radiology.unit.unit-listing', compact('unit'));
    }

    public function save_unit_details(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
        ]);

        $status = RadiologyUnit::Insert([
            'unit_name' => $request->unit_name,
           
        ]);

        if ($status) {
            return back()->with('success', " Unit Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_unit_details($id)
    {
        $unit = RadiologyUnit::all();
        $editUnit = RadiologyUnit::where('id', $id)->first();

        return view('setup.radiology.unit.edit-unit', compact('unit', 'editUnit'));
    }

    public function update_unit_details(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
        ]);

        $unit = RadiologyUnit::find($request->id);
        $unit->unit_name = $request->unit_name;
       
        $status = $unit->save();

        if ($status) {
            return redirect()->route('radiology-unit-details')->with('success', " Unit Updated Successfully");
        } else {
            return redirect()->route('radiology-unit-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_unit_details($id)
    {
        RadiologyUnit::find($id)->delete();

        return back()->with('success', "Unit Deleted Successfully");
    }
}

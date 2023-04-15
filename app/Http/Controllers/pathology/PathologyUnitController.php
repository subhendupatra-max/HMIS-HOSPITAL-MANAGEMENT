<?php

namespace App\Http\Controllers\pathology;

use App\Http\Controllers\Controller;
use App\Models\PathologyUnit;
use Illuminate\Http\Request;

class PathologyUnitController extends Controller
{
    public function unit_details()
    {
        $unit = PathologyUnit::all();

        return view('setup.pathology.unit.unit-listing', compact('unit'));
    }

    public function save_unit_details(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
        ]);

        $status = PathologyUnit::Insert([
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
        $unit = PathologyUnit::all();
        $editUnit = PathologyUnit::where('id', $id)->first();

        return view('setup.pathology.unit.edit-unit', compact('unit', 'editUnit'));
    }

    public function update_unit_details(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
        ]);

        $unit = PathologyUnit::find($request->id);
        $unit->unit_name = $request->unit_name;
       
        $status = $unit->save();

        if ($status) {
            return redirect()->route('pathology-unit-details')->with('success', " Unit Updated Successfully");
        } else {
            return redirect()->route('pathology-unit-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_unit_details($id)
    {
        PathologyUnit::find($id)->delete();

        return back()->with('success', "Unit Deleted Successfully");
    }
}

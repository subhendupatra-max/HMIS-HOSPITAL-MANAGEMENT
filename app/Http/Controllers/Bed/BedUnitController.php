<?php

namespace App\Http\Controllers\Bed;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\BedUnit;
use Illuminate\Http\Request;

class BedUnitController extends Controller
{
    public function bedUnit_details()
    {
        $bedUnit = BedUnit::where('is_active','=',1)->get();
        return view('setup.bedunit.bedunit-listing', compact('bedUnit'));
    }

    public function save_bed_unit_details(Request $request)
    {
        $validate = $request->validate([
            'bedUnit_name' => 'required',
        ]);

        $status = BedUnit::insert([
            'bedUnit_name' => $request->bedUnit_name,
        ]);

        if ($status) {
            return back()->with('success', "BedUnit Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_bed_unit_details($id, Request $request)
    {
        $bedUnit = BedUnit::where('is_active','=',1)->get();
        $editBedUnit = BedUnit::find($id);
        return view('setup.bedunit.bedunit-edit', compact('bedUnit', 'editBedUnit'));
    }

    public function update_bed_unit_details(Request $request)
    {
        $validate = $request->validate([
            'bedUnit_name' => 'required',
        ]);

        $bedUnit = BedUnit::find($request->id);
        $bedUnit->bedUnit_name = $request->bedUnit_name;

        $status = $bedUnit->save();

        if ($status) {
            return redirect()->route('bed-unit-details')->with('success', 'Bed Unit Edited Sucessfully');
        } else {
            return redirect()->route('bed-unit-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_bed_unit_details($id)
    {
        $bedUnit = BedUnit::where('id',$id)->update(['is_active' => '0', 'is_delete' => '1']);

        return redirect()->route('bed-unit-details')->with('success', 'Bed Unit Deleted Sucessfully');
    }
}

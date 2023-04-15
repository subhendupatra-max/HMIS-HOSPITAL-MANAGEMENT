<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\MedicineUnit;
use Illuminate\Http\Request;

class MedicineUnitController extends Controller
{
    public function medicine_unit_listing()
    {
        $unit = MedicineUnit::all();

        return view('setup.pharmacy.medicine-unit.medicine-unit-listing', compact('unit'));
    }

    public function save_medicine_unit(Request $request)
    {
        $request->validate([
            'medicine_unit_name' => 'required',
        ]);

        $status = MedicineUnit::Insert([
            'medicine_unit_name' => $request->medicine_unit_name,
        ]);

        if ($status) {
            return back()->with('success', " Unit Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_unit($id)
    {
        $unit = MedicineUnit::all();
        $editUnit = MedicineUnit::where('id', $id)->first();

        return view('setup.pharmacy.medicine-unit.edit-medicine-unit', compact('unit', 'editUnit'));
    }

    public function update_medicine_unit(Request $request)
    {
        $request->validate([
            'medicine_unit_name' => 'required',
        ]);

        $unit = MedicineUnit::find($request->id);
        $unit->medicine_unit_name = $request->medicine_unit_name;
        $status = $unit->save();

        if ($status) {
            return redirect()->route('medicine-unit-details')->with('success', " Unit Updated Successfully");
        } else {
            return redirect()->route('medicine-unit-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_unit($id)
    {
        MedicineUnit::find($id)->delete();

        return back()->with('success', "Unit Deleted Successfully");
    }
}

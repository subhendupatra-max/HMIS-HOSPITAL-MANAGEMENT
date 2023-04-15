<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChargesUnit;
use Illuminate\Http\Request;

class ChargesUnitController extends Controller
{
    public function charges_unit_details()
    {
        $unit = ChargesUnit::all();

        return view('setup.charges-unit.charges-unit', compact('unit'));
    }

    public function save_charges_unit_details(Request $request)
    {
        $request->validate([
            'charges_units_name' => 'required',
        ]);

        $status = ChargesUnit::Insert([
            'charges_units_name' => $request->charges_units_name,
           
        ]);

        if ($status) {
            return back()->with('success', " Catagory Unit Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_unit_details($id)
    {
        $unit = ChargesUnit::all();
        $editUnit = ChargesUnit::where('id', $id)->first();

        return view('setup.charges-unit.edit-charges-unit', compact('unit', 'editUnit'));
    }

    public function update_charges_unit_details(Request $request)
    {
        $request->validate([
            'charges_units_name' => 'required',
        ]);

        $charges = ChargesUnit::find($request->id);
        $charges->charges_units_name = $request->charges_units_name;
    
        $status = $charges->save();

        if ($status) {
            return redirect()->route('charges-unit-details')->with('success', " Catagory Unit Updated Successfully");
        } else {
            return redirect()->route('charges-unit-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_unit_details($id)
    {
        ChargesUnit::find($id)->delete();

        return back()->with('success', "Catagory Unit Deleted Successfully");
    }
}

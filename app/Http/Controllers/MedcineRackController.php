<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicineRack;

class MedcineRackController extends Controller

{ public function medicine_rack_listing()
    {
        $medicineRack = MedicineRack::all();

        return view('setup.pharmacy.medicine-rack.medicine-rack-listing', compact('medicineRack'));
    }

    public function save_medicine_rack(Request $request)
    {
        $request->validate([
            'medicine_rack_name' => 'required',
        ]);

        $status = MedicineRack::Insert([
            'medicine_rack_name' => $request->medicine_rack_name,
         
        ]);

        if ($status) {
            return back()->with('success', " Medicine Rack Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_rack($id)
    {
        $medicineRack = MedicineRack::all();
        $editMedicineRack = MedicineRack::where('id', $id)->first();

        return view('setup.pharmacy.medicine-rack.edit-medicine-rack', compact('medicineRack', 'editMedicineRack'));
    }

    public function update_medicine_rack(Request $request)
    {
        $request->validate([
            'medicine_rack_name' => 'required',
        ]);

        $charges = MedicineRack::find($request->id);
        $charges->medicine_rack_name = $request->medicine_rack_name;
       
        $status = $charges->save();

        if ($status) {
            return redirect()->route('medicine-rack-details')->with('success', " Medicine Rack
             Updated Successfully");
        } else {
            return redirect()->route('medicine-rack-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_rack($id)
    {
        MedicineRack::find($id)->delete();

        return back()->with('success', "Medicine Rack Deleted Successfully");
    }
}

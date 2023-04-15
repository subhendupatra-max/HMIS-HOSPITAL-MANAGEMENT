<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Dosage;
use App\Models\MedicineCatagory;
use App\Models\MedicineUnit;
use Illuminate\Http\Request;

class MedicineDosageController extends Controller
{
    public function medicine_dosage_listing()
    {
        $dosage   = Dosage::all();
        $unit     = MedicineUnit::all();
        $catagory = MedicineCatagory::all();
        return view('setup.pharmacy.medicine-dosage.medicine-dosage-listing', compact('dosage', 'catagory', 'unit'));
    }

    public function save_medicine_dosage(Request $request)
    {
        $request->validate([
            'medicine_catagory_id'  => 'required',

        ]);

        foreach ($request->medicine_unit_id as $key => $medicine_catagory_id) {
            $dosage = new Dosage();
            $dosage->medicine_catagory_id = $request->medicine_catagory_id;
            $dosage->medicine_unit_id     = $request->medicine_unit_id[$key];
            $dosage->dose                 = $request->dose[$key];
            $status = $dosage->save();
        }

        if ($status) {
            return back()->with('success', "Dosage Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_dosage($id)
    {
        $dosage   = Dosage::all();
        $editDosage = Dosage::where('id', $id)->get();
        $catagory = MedicineCatagory::all();
        $unit = MedicineUnit::all();


        return view('setup.pharmacy.medicine-dosage.edit-medicine-dosage', compact('id', 'dosage', 'editDosage', 'catagory', 'unit'));
    }

    public function update_medicine_dosage(Request $request)
    {
        $request->validate([
            'medicine_catagory_id'  => 'required',

        ]);
        Dosage::where('id', $request->id)->delete();

        foreach ($request->medicine_unit_id as $key => $medicine_catagory_id) {
            $dosage = new Dosage();
            $dosage->medicine_catagory_id = $request->medicine_catagory_id;
            $dosage->medicine_unit_id     = $request->medicine_unit_id[$key];
            $dosage->dose                 = $request->dose[$key];
            $status = $dosage->save();
        }
        if ($status) {
            return redirect()->route('medicine-dosage-details')->with('success', " Dosage Updated Successfully");
        } else {
            return redirect()->route('medicine-dosage-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_dosage($id)
    {
        Dosage::find($id)->delete();

        return back()->with('success', "Dosage Deleted Successfully");
    }
}

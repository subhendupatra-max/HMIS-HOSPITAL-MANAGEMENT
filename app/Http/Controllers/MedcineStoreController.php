<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicineStore;


class MedcineStoreController extends Controller
{
    public function medicine_store_listing()
    {
        $medicineStore = MedicineStore::all();

        return view('setup.pharmacy.medicine-store.medicine-store-listing', compact('medicineStore'));
    }

    public function save_medicine_store(Request $request)
    {
        $request->validate([
            'medicine_store_name' => 'required',
        ]);

        $status = MedicineStore::Insert([
            'medicine_store_name' => $request->medicine_store_name,
         
        ]);

        if ($status) {
            return back()->with('success', " Medicine Store Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_store($id)
    {
        $medicineStore = MedicineStore::all();
        $editMedicineStore = MedicineStore::where('id', $id)->first();

        return view('setup.pharmacy.medicine-store.edit-medicine-store', compact('medicineStore', 'editMedicineStore'));
    }

    public function update_medicine_store(Request $request)
    {
        $request->validate([
            'medicine_store_name' => 'required',
        ]);

        $charges = MedicineStore::find($request->id);
        $charges->medicine_store_name = $request->medicine_store_name;
       
        $status = $charges->save();

        if ($status) {
            return redirect()->route('medicine-store-details')->with('success', " Medicine Store Updated Successfully");
        } else {
            return redirect()->route('medicine-store-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_store($id)
    {
        MedicineStore::find($id)->delete();

        return back()->with('success', "Medicine Store Deleted Successfully");
    }
}

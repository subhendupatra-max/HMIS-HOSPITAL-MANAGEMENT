<?php

namespace App\Http\Controllers\pharmacy;

use App\Http\Controllers\Controller;
use App\Models\MedicineCatagory;
use Illuminate\Http\Request;

class MedicineCatagoryController extends Controller
{
    public function medicine_catagory_listing()
    {
        $catagory = MedicineCatagory::all();

        return view('setup.pharmacy.medicine-catagory.medicine-catagory-listing', compact('catagory'));
    }

    public function save_medicine_catagory(Request $request)
    {
        $request->validate([
            'medicine_catagory_name' => 'required',
        ]);

        $status = MedicineCatagory::Insert([
            'medicine_catagory_name' => $request->medicine_catagory_name,
        ]);

        if ($status) {
            return back()->with('success', " Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_medicine_catagory($id)
    {
        $catagory = MedicineCatagory::all();
        $editCatagory = MedicineCatagory::where('id', $id)->first();

        return view('setup.pharmacy.medicine-catagory.edit-medicine-catagory', compact('catagory', 'editCatagory'));
    }

    public function update_medicine_catagory(Request $request)
    {
        $request->validate([
            'medicine_catagory_name' => 'required',
        ]);

        $charges = MedicineCatagory::find($request->id);
        $charges->medicine_catagory_name = $request->medicine_catagory_name;
        $status = $charges->save();

        if ($status) {
            return redirect()->route('medicine-catagory-details')->with('success', " Catagory Updated Successfully");
        } else {
            return redirect()->route('medicine-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_catagory($id)
    {
        MedicineCatagory::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

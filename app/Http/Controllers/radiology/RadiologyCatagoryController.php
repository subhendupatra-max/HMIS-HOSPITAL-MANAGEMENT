<?php

namespace App\Http\Controllers\radiology;

use App\Http\Controllers\Controller;
use App\Models\RadiologyCatagory;
use Illuminate\Http\Request;

class RadiologyCatagoryController extends Controller
{

    public function catagory_details()
    {
        $catagory = RadiologyCatagory::all();

        return view('setup.radiology.catagory.catagory-listing', compact('catagory'));
    }

    public function save_catagory_details(Request $request)
    {
        $request->validate([
            'catagory_name' => 'required',
        ]);

        $status = RadiologyCatagory::Insert([
            'catagory_name' => $request->catagory_name,

        ]);

        if ($status) {
            return back()->with('success', " Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_catagory_details($id)
    {
        $catagory = RadiologyCatagory::all();
        $editCatagory = RadiologyCatagory::where('id', $id)->first();

        return view('setup.radiology.catagory.edit-catagory', compact('catagory', 'editCatagory'));
    }

    public function update_catagory_details(Request $request)
    {
        $request->validate([
            'catagory_name' => 'required',
        ]);

        $catagory = RadiologyCatagory::find($request->id);
        $catagory->catagory_name = $request->catagory_name;

        $status = $catagory->save();

        if ($status) {
            return redirect()->route('radiology-catagory-details')->with('success', " Catagory Updated Successfully");
        } else {
            return redirect()->route('radiology-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_catagory_details($id)
    {
        RadiologyCatagory::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

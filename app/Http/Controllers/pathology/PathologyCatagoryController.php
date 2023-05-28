<?php

namespace App\Http\Controllers\pathology;

use App\Http\Controllers\Controller;
use App\Models\PathologyCatagory;
use Illuminate\Http\Request;

class PathologyCatagoryController extends Controller
{

    public function catagory_details()
    {
        $catagory = PathologyCatagory::all();

        return view('setup.pathology.catagory.catagory-listing', compact('catagory'));
    }

    public function save_catagory_details(Request $request)
    {
        $request->validate([
            'catagory_name' => 'required',
        ]);

        $status = PathologyCatagory::Insert([
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
        $catagory = PathologyCatagory::all();
        $editCatagory = PathologyCatagory::where('id', $id)->first();

        return view('setup.pathology.catagory.edit-catagory', compact('catagory', 'editCatagory'));
    }

    public function update_catagory_details(Request $request)
    {
        $request->validate([
            'catagory_name' => 'required',
        ]);

        $catagory = PathologyCatagory::find($request->id);
        $catagory->catagory_name = $request->catagory_name;

        $status = $catagory->save();

        if ($status) {
            return redirect()->route('pathology-catagory-details')->with('success', " Catagory Updated Successfully");
        } else {
            return redirect()->route('pathology-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_catagory_details($id)
    {
        PathologyCatagory::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

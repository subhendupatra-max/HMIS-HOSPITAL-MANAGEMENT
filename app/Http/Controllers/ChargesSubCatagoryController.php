<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChargesCatagory;
use Illuminate\Http\Request;
use  App\Models\ChargesSubCatagory;

class ChargesSubCatagoryController extends Controller
{
    public function charges_sub_catagory_details()
    {
        $subcatagory = ChargesSubCatagory::all();
        $catagory = ChargesCatagory::all();
        return view('setup.charges-sub-catagory.sub-catagory-listing', compact('catagory','subcatagory'));
    }

    public function save_charges_sub_catagory_details(Request $request)
    {
        $request->validate([
            'charges_sub_catagories_name' => 'required',
            'charges_catagories_id' => 'required',
        ]);

        $status = ChargesSubCatagory::Insert([
            'charges_sub_catagories_name' => $request->charges_sub_catagories_name,
            'charges_catagories_id' => $request->charges_catagories_id,
            'description' => $request->description,
        ]);

        if ($status) {
            return back()->with('success', "Sub Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_sub_catagory_details($id)
    {
        $subcatagory = ChargesSubCatagory::all();
        $editSubCatagory = ChargesSubCatagory::where('id', $id)->first();
        $catagory = ChargesCatagory::all();
        return view('setup.charges-sub-catagory.edit-sub-catagory', compact('subcatagory', 'editSubCatagory','catagory'));
    }

    public function update_charges_sub_catagory_details(Request $request)
    {
        $request->validate([
            'charges_sub_catagories_name' => 'required',
            'charges_catagories_id' => 'required',
        ]);

        $charges = ChargesSubCatagory::find($request->id);
        $charges->charges_sub_catagories_name = $request->charges_sub_catagories_name;
        $charges->charges_catagories_id = $request->charges_catagories_id;
        $charges->description = $request->description;

        $status = $charges->save();

        if ($status) {
            return redirect()->route('charges-sub-catagory-details')->with('success', "Sub Catagory Updated Successfully");
        } else {
            return redirect()->route('charges-sub-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_sub_catagory_details($id)
    {
        ChargesSubCatagory::find($id)->delete();

        return back()->with('success', "Sub Catagory Deleted Successfully");
    }
}

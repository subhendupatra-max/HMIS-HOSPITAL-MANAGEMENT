<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChargesCatagory;
use App\Models\ChargesUnit;
use Illuminate\Http\Request;

class ChargesCatagoryController extends Controller
{
    public function charges_catagory_details()
    {
        $catagory = ChargesCatagory::all();

        return view('setup.charges-catagory.charges-catagory-listing', compact('catagory'));
    }

    public function save_charges_catagory_details(Request $request)
    {
        $request->validate([
            'charges_catagories_name' => 'required',
        ]);

        $status = ChargesCatagory::Insert([
            'charges_catagories_name' => $request->charges_catagories_name,
            'description' => $request->description,
        ]);

        if ($status) {
            return back()->with('success', " Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_catagory_details($id)
    {
        $catagory = ChargesCatagory::all();
        $editCatagory = ChargesCatagory::where('id', $id)->first();

        return view('setup.charges-catagory.edit-charges-catagory', compact('catagory', 'editCatagory'));
    }

    public function update_charges_catagory_details(Request $request)
    {
        $request->validate([
            'charges_catagories_name' => 'required',
        ]);

        $charges = ChargesCatagory::find($request->id);
        $charges->charges_catagories_name = $request->charges_catagories_name;
        $charges->description = $request->description;

        $status = $charges->save();

        if ($status) {
            return redirect()->route('charges-catagory-details')->with('success', " Catagory Updated Successfully");
        } else {
            return redirect()->route('charges-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_catagory_details($id)
    {
        ChargesCatagory::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

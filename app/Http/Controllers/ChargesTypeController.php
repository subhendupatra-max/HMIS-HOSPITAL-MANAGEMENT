<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChargeType;

class ChargesTypeController extends Controller
{
    public function charges_type_details()
    {
        $charge_type = ChargeType::where('is_active', 1)->get();
        return view('setup.charges-type.charges-type-listing', compact('charge_type'));
    }

    public function save_charges_type_details(Request $request)
    {
        $request->validate([
            'charge_type_name' => 'required',
        ]);

        $status = ChargeType::Insert([
            'charge_type_name' => $request->charge_type_name,
        ]);

        if ($status) {
            return back()->with('success', "Charge Type  Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_type_details($id)
    {
        $charge_type = ChargeType::where('is_active', 1)->get();
        $editChargesType = ChargeType::where('id', $id)->first();

        return view('setup.charges-type.edit-charges-type', compact('charge_type', 'editChargesType'));
    }

    public function update_charges_type_details(Request $request)
    {
        $request->validate([
            'charge_type_name' => 'required',
        ]);

        $charges = ChargeType::find($request->id);
        $charges->charge_type_name = $request->charge_type_name;
        $status = $charges->save();

        if ($status) {
            return redirect()->route('charges-type-details')->with('success', "Charge Type Updated Successfully");
        } else {
            return redirect()->route('charges-type-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_type_details($id)
    {
       
        ChargeType::where('id',$id)->update(['is_active' => '0']);

        return back()->with('success', "Charge Type Deleted Successfully");
    }
}

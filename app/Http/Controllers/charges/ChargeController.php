<?php

namespace App\Http\Controllers\charges;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\ChargesCatagory;
use App\Models\ChargesSubCatagory;
use App\Models\ChargesUnit;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ChargeController extends Controller
{

    public function charges_details()
    {
        $charges = Charge::all();
        $charges_catagory_id = ChargesCatagory::all();
        $charges_sub_catagory_id = ChargesSubCatagory::all();
        $charges_units_id = ChargesUnit::all();
        return view('setup.charges.charges-listing', compact('charges', 'charges_catagory_id', 'charges_sub_catagory_id', 'charges_units_id'));
    }

    public function save_charges_details(Request $request)
    {
        $request->validate([
            'charges_catagory_id'       => 'required',
            'charges_sub_catagory_id'   => 'required',
            'charges_units_id'           => 'required',
            'charges_name'              => 'required',
            'standard_charges'          => 'required',
        ]);

        $charges = Charge::Insert([

            'charges_catagory_id'            => $request->charges_catagory_id,
            'charges_sub_catagory_id'        => $request->charges_sub_catagory_id,
            'charges_unit_id'                => $request->charges_units_id,
            'charges_name'                   => $request->charges_name,
            'standard_charges'               => $request->standard_charges,
            'date'                           => \Carbon\Carbon::parse($request->date)->format('Y-m-d'),
            'description'                    => $request->description,

        ]);

        if($charges){
            return back()->with('success', "Charges Added Sucessfully");
        }else{
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_details($id,Request $request)
    {
        $charges = Charge::all();
        $editCharges = Charge::where('id','=',$id)->first();
        $charges_catagory_id = ChargesCatagory::all();
        $charges_sub_catagory_id = ChargesSubCatagory::all();
        $charges_units_id = ChargesUnit::all();

        return view('setup.charges.edit-charges', compact('charges','editCharges', 'charges_catagory_id', 'charges_sub_catagory_id', 'charges_units_id'));
    }

    public function update_charges_details(Request $request)
    {
    
        $request->validate([
            'charges_catagory_id'       => 'required',
            'charges_sub_catagory_id'   => 'required',
            'charges_units_id'           => 'required',
            'charges_name'              => 'required',
            'standard_charges'          => 'required',
        ]);

        $charges = Charge::find($request->id);
        $charges->charges_catagory_id = $request->charges_catagory_id ;
        $charges->charges_sub_catagory_id = $request->charges_sub_catagory_id ;
        $charges->charges_unit_id = $request->charges_units_id ;
        $charges->charges_name = $request->charges_name ;
        $charges->standard_charges = $request->standard_charges ;
        $charges->date = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $charges->description = $request->description ;

        $status =  $charges->save();
        if($status){
            return redirect()->route('charges-details')->with('success', "Charges Edited Sucessfully");
        }else{
            return redirect()->route('charges-details')->with('error', "Something Went Wrong");
        }

    }

    public function delete_charges_details($id)
    {
        Charge::find($id)->delete();
        return back()->with('success' , "Charges Deleted Succesfully");
    }


}

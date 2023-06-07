<?php

namespace App\Http\Controllers\charges;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\ChargesCatagory;
use App\Models\ChargesSubCatagory;
use App\Models\ChargesUnit;
use App\Models\ChargeType;
use App\Models\ChargesWithChargesType;
use Illuminate\Http\Request;
use DB;

use function Ramsey\Uuid\v1;

class ChargeController extends Controller
{

    public function charges_details(Request $request)
    {
        if(empty($request->all()))
        {
            $charges = Charge::orderBy('charges_name','ASC')->paginate(10); 
        }
        else{
            $charges = Charge::where('charges_name','like','%'.$request->charge_name.'%')->orderBy('charges_name','ASC')->paginate(10);
        }
       
        $charges_catagory_id = ChargesCatagory::all();
        $charges_sub_catagory_id = ChargesSubCatagory::all();
        $charges_units_id = ChargesUnit::all();
        return view('setup.charges.charges-listing', compact('charges', 'charges_catagory_id', 'charges_sub_catagory_id', 'charges_units_id'));
    }
    public function charges_add()
    {
        $charges = Charge::all();
        $charges_catagory_id = ChargesCatagory::all();
        $charges_sub_catagory_id = ChargesSubCatagory::all();
        $charges_units_id = ChargesUnit::all();
        $charges_type = ChargeType::where('is_active','1')->get();
        return view('setup.charges.add-charges', compact('charges_type','charges', 'charges_catagory_id', 'charges_sub_catagory_id', 'charges_units_id'));
    }

    public function save_charges_details(Request $request)
    {
        try {
        DB::beginTransaction();
            $request->validate([
                'charges_catagory_id'       => 'required',
                'charges_sub_catagory_id'   => 'required',
                'charges_name'              => 'required',
            ]);

            $charge = new Charge;
            $charge->charges_catagory_id = $request->charges_catagory_id;
            $charge->charges_sub_catagory_id = $request->charges_sub_catagory_id;
            $charge->charges_name = $request->charges_name;
            $charge->date = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
            $charge->description = $request->description;
            $charge->save();
            $insertId = $charge->id;
            if (@$request->charge_type_id) {
                foreach ($request->charge_type_id as $key => $value) {
                    $Charges_With_Charges_Type = new ChargesWithChargesType;
                    $Charges_With_Charges_Type->charge_type_id = $request->charge_type_id[$key];
                    $Charges_With_Charges_Type->charge_id = $insertId;
                    $Charges_With_Charges_Type->standard_charges = $request->charge_amount[$key];
                    $Charges_With_Charges_Type->save();
                }
            }
            
            DB::commit();
            if (true) {
                return redirect()->route('charges-details')->with('success', "Charges Added Sucessfully");
            } else {
                return back()->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit_charges_details($id, Request $request)
    {
        $charges = Charge::all();
        $editCharges = Charge::where('id', '=', $id)->first();
        $editChargeseithtype = ChargesWithChargesType::where('charge_id', '=', $id)->get();
        $charges_catagory_id = ChargesCatagory::all();
        $charges_sub_catagory_id = ChargesSubCatagory::all();
        $charges_units_id = ChargesUnit::all();
        $charges_type = ChargeType::where('is_active','1')->get();

        return view('setup.charges.edit-charges', compact('charges_type','editChargeseithtype','charges', 'editCharges', 'charges_catagory_id', 'charges_sub_catagory_id', 'charges_units_id'));
    }

    public function update_charges_details(Request $request)
    {
        try {
            DB::beginTransaction();
        $request->validate([
            'charges_catagory_id'       => 'required',
            'charges_sub_catagory_id'   => 'required',
            'charges_name'              => 'required',

        ]);

        $charges = Charge::find($request->id);
        $charges->charges_catagory_id = $request->charges_catagory_id;
        $charges->charges_sub_catagory_id = $request->charges_sub_catagory_id;
        $charges->charges_name = $request->charges_name;
        $charges->date = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $charges->description = $request->description;

        ChargesWithChargesType::where('charge_id',$request->id)->delete();

        if (@$request->charge_type_id) {
            foreach ($request->charge_type_id as $key => $value) {
                $Charges_With_Charges_Type = new ChargesWithChargesType;
                $Charges_With_Charges_Type->charge_type_id = $request->charge_type_id[$key];
                $Charges_With_Charges_Type->charge_id = $request->id;
                $Charges_With_Charges_Type->standard_charges = $request->charge_amount[$key];
                $Charges_With_Charges_Type->save();
            }
        }
        $status =  $charges->save();
        DB::commit();
        if ($status) {
            return redirect()->route('charges-details')->with('success', "Charges Edited Sucessfully");
        } else {
            return redirect()->route('charges-details')->with('error', "Something Went Wrong");
        }
    } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back()->with('error', $th->getMessage());
    }
    }

    public function delete_charges_details($id)
    {
        Charge::find($id)->delete();
        ChargesWithChargesType::where('charge_id',$id)->delete();
        return back()->with('success', "Charges Deleted Succesfully");
    }
}

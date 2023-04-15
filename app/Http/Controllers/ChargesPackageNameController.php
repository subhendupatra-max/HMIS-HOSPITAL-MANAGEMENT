<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChargesPackageName;
use Illuminate\Http\Request;
use App\Models\ChargesPackageCatagory;
use App\Models\ChargesPackageSubCatagory;
use App\Models\Charge;
use DB;
use App\Models\ChargesPackageDetails;

class ChargesPackageNameController extends Controller
{
    public function charges_package_name_details()
    {
        $chargePackageName = ChargesPackageName::all();

        return view('setup.charges-package.package-name.package-name-listing', compact('chargePackageName'));
    }

    public function add_charges_package_name_details()
    {

        $catagory    = ChargesPackageCatagory::all();
        $chargeName = Charge::all();

        return view('setup.charges-package.package-name.add-charges-package-name', compact('catagory', 'chargeName'));
    }

    public function save_charges_package_name_details(Request $request)
    {
        $request->validate([
            'charge_package_sub_catagory_id'  => 'required',
            'charge_package_catagory_id'      => 'required',
            'package_name'                    => 'required',
            'total_amount'                    => 'required',
        ]);
        try {
            DB::beginTransaction();

            $chargeName = new ChargesPackageName();
            $chargeName->charge_package_sub_catagory_id    = $request->charge_package_sub_catagory_id;
            $chargeName->charge_package_catagory_id        = $request->charge_package_catagory_id;
            $chargeName->package_name                      = $request->package_name;
            $chargeName->total_amount                      = $request->total_amount;
            $chargeName->tax                               = $request->tax;
            $status = $chargeName->save();

            foreach ($request->charge_name as $key => $charge) {
                $dosage = new ChargesPackageDetails();
                $dosage->charge_package_name_id     = $chargeName->id;
                $dosage->charge_name                = $request->charge_name[$key];
                $dosage->charge_amount              = $request->charge_amount[$key];
                $status = $dosage->save();
            }


            if ($status) {
                return back()->with('success', " Charges Package Sub Catagory Added Succesfully ");
            } else {
                return back()->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit_charges_package_name_details($id)
    {
        $chargeName = Charge::all();
        $catagory        = ChargesPackageCatagory::all();
        $editPackageName = ChargesPackageName::where('id', $id)->first();

        return view('setup.charges-package.package-name.edit-package-name', compact('chargeName', 'catagory', 'editPackageName'));
    }

    public function update_charges_package_name_details(Request $request)
    {
        $request->validate([
            'charge_package_sub_catagory_id'  => 'required',
            'charge_package_catagory_id'      => 'required',
            'package_name'                    => 'required',
            'total_amount'                    => 'required',
        ]);
        try {
            DB::beginTransaction();

            $chargeName = ChargesPackageName::find($request->id);
            $chargeName->charge_package_sub_catagory_id    = $request->charge_package_sub_catagory_id;
            $chargeName->charge_package_catagory_id        = $request->charge_package_catagory_id;
            $chargeName->package_name                      = $request->package_name;
            $chargeName->total_amount                      = $request->total_amount;
            $chargeName->tax                               = $request->tax;
            $status = $chargeName->save();

            ChargesPackageDetails::where('id', $request->id)->delete();

            foreach ($request->charge_name as $key => $charge) {
                $dosage = new ChargesPackageDetails();
                $dosage->charge_package_name_id     = $chargeName->id;
                $dosage->charge_name                = $request->charge_name[$key];
                $dosage->charge_amount              = $request->charge_amount[$key];
                $status = $dosage->save();
            }

            if ($status) {
                return back()->with('success', " Charges Package Updated Succesfully ");
            } else {
                return back()->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete_charges_package_name_details($id)
    {
        ChargesPackageSubCatagory::find($id)->delete();

        return back()->with('success', " Charges Package Deleted Successfully");
    }

    public function find_charge_amount_by_charge_name(Request $request)
    {
        $charge_amount = Charge::where('id', $request->charges_id)->first();

        return response()->json($charge_amount);
    }

    public function find_charger_package_sub_catagoyr_by_catagory(Request $request)
    {
        $charges_package_sub_catagory = ChargesPackageSubCatagory::where('charges_package_catagory_id', $request->catagory_id)->get();

        return response()->json($charges_package_sub_catagory);
    }
}

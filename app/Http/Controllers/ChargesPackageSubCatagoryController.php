<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChargesPackageSubCatagory;
use App\Models\ChargesPackageCatagory;

class ChargesPackageSubCatagoryController extends Controller
{
    public function charges_package_sub_catagory_details()
    {
        $subCatagory = ChargesPackageSubCatagory::all();
        $catagory    = ChargesPackageCatagory::all();

        return view('setup.charges-package.package-sub-catagory.package-sub-catagory-listing', compact('subCatagory', 'catagory'));
    }

    public function save_charges_package_sub_catagory_details(Request $request)
    {
        $request->validate([
            'charges_package_sub_catagory_name' => 'required',
            'charges_package_catagory_id'       => 'required',
        ]);

        $status = ChargesPackageSubCatagory::Insert([
            'charges_package_catagory_id'       => $request->charges_package_catagory_id,
            'charges_package_sub_catagory_name' => $request->charges_package_sub_catagory_name,
        ]);

        if ($status) {
            return back()->with('success', " Charges Package Sub Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_package_sub_catagory_details($id)
    {
        $catagory    = ChargesPackageCatagory::all();
        $subCatagory = ChargesPackageSubCatagory::all();
        $editSubCatagory = ChargesPackageSubCatagory::where('id', $id)->first();

        return view('setup.charges-package.package-sub-catagory.edit-package-sub-catagory', compact('subCatagory', 'editSubCatagory', 'catagory'));
    }

    public function update_charges_package_sub_catagory_details(Request $request)
    {
        $request->validate([
            'charges_package_sub_catagory_name'     => 'required',
            'charges_package_catagory_id'           => 'required',
        ]);

        $charges = ChargesPackageSubCatagory::find($request->id);
        $charges->charges_package_catagory_id       = $request->charges_package_catagory_id;
        $charges->charges_package_sub_catagory_name = $request->charges_package_sub_catagory_name;

        $status = $charges->save();

        if ($status) {
            return redirect()->route('charges-package-sub-catagory-details')->with('success', " Charges Package Sub Catagory Updated Successfully");
        } else {
            return redirect()->route('charges-package-sub-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_package_sub_catagory_details($id)
    {
        ChargesPackageSubCatagory::find($id)->delete();

        return back()->with('success', " Charges Package Sub Catagory Deleted Successfully");
    }
}

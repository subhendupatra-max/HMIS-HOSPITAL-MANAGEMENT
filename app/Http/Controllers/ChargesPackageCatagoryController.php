<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChargesPackageCatagory;

class ChargesPackageCatagoryController extends Controller
{
    public function charges_package_catagory_details()
    {
        $catagory = ChargesPackageCatagory::all();

        return view('setup.charges-package.package-catagory.package-catagory-listing', compact('catagory'));
    }

    public function save_charges_package_catagory_details(Request $request)
    {
        $request->validate([
            'charges_package_catagories_name' => 'required',
        ]);

        $status = ChargesPackageCatagory::Insert([
            'charges_package_catagories_name' => $request->charges_package_catagories_name,
        ]);

        if ($status) {
            return back()->with('success', "Charges Package Catagory Added Succesfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_charges_package_catagory_details($id)
    {
        $catagory = ChargesPackageCatagory::all();
        $editCatagory = ChargesPackageCatagory::where('id', $id)->first();

        return view('setup.charges-package.package-catagory.edit-package-catagory', compact('catagory', 'editCatagory'));
    }

    public function update_charges_package_catagory_details(Request $request)
    {
        $request->validate([
            'charges_package_catagories_name' => 'required',
        ]);

        $charges = ChargesPackageCatagory::find($request->id);
        $charges->charges_package_catagories_name = $request->charges_package_catagories_name;
        $status = $charges->save();

        if ($status) {
            return redirect()->route('charges-package-catagory-details')->with('success', " Charges Package Catagory Updated Successfully");
        } else {
            return redirect()->route('charges-package-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_charges_package_catagory_details($id)
    {
        ChargesPackageCatagory::find($id)->delete();

        return back()->with('success', " Charges Package Catagory Deleted Successfully ");
    }
}

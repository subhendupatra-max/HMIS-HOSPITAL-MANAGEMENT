<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function item_manufacture_details()
    {
        $manufacture = Manufacture::all();

        return view('setup.Inventory.manufacture.manufacture-details', compact('manufacture'));
    }

    public function save_item_manufacture(Request $request)
    {
        $request->validate([
            'manufacture_name' => 'required',
        ]);

        $status = Manufacture::Insert([
            'manufacture_name' => $request->manufacture_name,
        ]);

        if ($status) {
            return back()->with('success', " Manufacture Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_item_manufacture($id)
    {
        $id = base64_decode($id);
        $manufacture = Manufacture::all();
        $editManufacture = Manufacture::where('id', $id)->first();

        return view('setup.Inventory.manufacture.edit-manufacture', compact('manufacture', 'editManufacture'));
    }

    public function update_item_manufacture(Request $request)
    {
        $request->validate([
            'manufacture_name' => 'required',
        ]);

        $manufacture = Manufacture::find($request->id);
        $manufacture->manufacture_name = $request->manufacture_name;
        $status = $manufacture->save();

        if ($status) {
            return redirect()->route('add-inventory-manufacture')->with('success', " Manufacture Updated Successfully");
        } else {
            return redirect()->route('add-inventory-manufacture')->with('error', "Something Went Wrong");
        }
    }

    public function delete_item_manufacture($id)
    {
        $id = base64_decode($id);
        Manufacture::find($id)->delete();

        return back()->with('success', "Manufacture Deleted Successfully");
    }
}

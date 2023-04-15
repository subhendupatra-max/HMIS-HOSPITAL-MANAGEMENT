<?php

namespace App\Http\Controllers;

use App\Models\OperationCatagory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationCatagoryController extends Controller
{
    public function operation_catagory_details()
    {
        $catagory = OperationCatagory::all();

        return view('setup.operations.catagory.catagory-listing', compact('catagory'));
    }

    public function save_operation_catagory_details(Request $request)
    {
        $request->validate([
            'operation_catagory_name' => 'required',
        ]);

        $status = OperationCatagory::Insert([
            'operation_catagory_name' => $request->operation_catagory_name,
        ]);

        if ($status) {
            return back()->with('success', " Catagory Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_operation_catagory_details($id)
    {
        $catagory = OperationCatagory::all();
        $editCatagory = OperationCatagory::where('id', $id)->first();

        return view('setup.operations.catagory.edit-catagory', compact('catagory', 'editCatagory'));
    }

    public function update_operation_catagory_details(Request $request)
    {
        $request->validate([
            'operation_catagory_name' => 'required',
        ]);

        $catagory = OperationCatagory::find($request->id);
        $catagory->operation_catagory_name = $request->operation_catagory_name;

        $status = $catagory->save();

        if ($status) {
            return redirect()->route('operation-catagory-details')->with('success', " Catagory Updated Successfully");
        } else {
            return redirect()->route('operation-catagory-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_operation_catagory_details($id)
    {
        OperationCatagory::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

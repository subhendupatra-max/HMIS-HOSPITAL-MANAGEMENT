<?php

namespace App\Http\Controllers;

use App\Models\OperationType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationTypeController extends Controller
{
    public function operation_type_details()
    {
        $type = OperationType::all();

        return view('setup.operations.type.type-listing', compact('type'));
    }

    public function save_operation_type_details(Request $request)
    {
        $request->validate([
            'operation_type_name' => 'required',
        ]);

        $status = OperationType::Insert([
            'operation_type_name' => $request->operation_type_name,
        ]);

        if ($status) {
            return back()->with('success', "Operation Type Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_operation_type_details($id)
    {
        $type = OperationType::all();
        $editType = OperationType::where('id', $id)->first();

        return view('setup.operations.type.edit-type', compact('type', 'editType'));
    }

    public function update_operation_type_details(Request $request)
    {
        $request->validate([
            'operation_type_name' => 'required',
        ]);

        $type = OperationType::find($request->id);
        $type->operation_type_name = $request->operation_type_name;

        $status = $type->save();
        if ($status) {
            return redirect()->route('operation-type-details')->with('success', " Operation Type Updated Successfully");
        } else {
            return redirect()->route('operation-type-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_operation_type_details($id)
    {
        OperationType::find($id)->delete();

        return back()->with('success', "Catagory Deleted Successfully");
    }
}

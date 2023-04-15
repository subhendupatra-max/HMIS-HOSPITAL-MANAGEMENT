<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Operation;
use App\Models\OperationCatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperationController extends Controller
{
    // setup operation
    public function operation_details()
    {
        $operation = Operation::all();
        $department = Department::where('is_active', '=', 1)->get();
        $operation_catagory = OperationCatagory::all();
        return view('setup.operations.operation.operation-listing', compact('operation', 'department', 'operation_catagory'));
    }

    public function save_operation_details(Request $request)
    {
        $request->validate([
            'operation_department' => 'required',
            'operation_catagory' => 'required',
            'operation_name' => 'required',
        ]);

        $status = Operation::Insert([
            'operation_department' => $request->operation_department,
            'operation_catagory' => $request->operation_catagory,
            'operation_name' => $request->operation_name,
        ]);

        if ($status) {
            return back()->with('success', "Operation Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_operation_details($id)
    {
        $operation = Operation::all();
        $department = Department::where('is_active', '=', 1)->get();
        $operation_catagory = OperationCatagory::all();
        $editOperation = Operation::where('id', $id)->first();

        return view('setup.operations.operation.edit-operation', compact('operation', 'editOperation', 'department', 'operation_catagory'));
    }

    public function update_operation_details(Request $request)
    {
        $request->validate([
            'operation_department' => 'required',
            'operation_catagory' => 'required',
            'operation_name' => 'required',
        ]);


        $operation = Operation::find($request->id);
        $operation->operation_department = $request->operation_department;
        $operation->operation_catagory = $request->operation_catagory;
        $operation->operation_name = $request->operation_name;

        $status = $operation->save();
        if ($status) {
            return redirect()->route('operation-details')->with('success', " Operation Updated Successfully");
        } else {
            return redirect()->route('operation-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_operation_details($id)
    {
        Operation::find($id)->delete();

        return back()->with('success', "Operation Deleted Successfully");
    }
    // setup operation

    

}

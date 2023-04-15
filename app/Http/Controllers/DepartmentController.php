<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    
    public function department_details()
    {
        $department = Department::where('is_active','=',1)->get();
        return view('setup.department.department-listing', compact('department'));
    }

    public function save_department_details(Request $request)
    {
        $validate = $request->validate([
            'department_name' => 'required',
            'department_code' => 'required',
        ]);

        $status = Department::insert([
            'department_name' => $request->department_name,
            'department_code' => $request->department_code,
        ]);

        if ($status) {
            return back()->with('success', "Department Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_department_details($id, Request $request)
    {
        $department = Department::where('is_active','=',1)->get();
        $editDepartment = Department::find($id);
        return view('setup.department.department-edit', compact('department', 'editDepartment'));
    }

    public function update_department_details(Request $request)
    {
        $validate = $request->validate([
            'department_name' => 'required',
            'department_code' => 'required',
        ]);

        $department = Department::find($request->id);
        $department->department_name = $request->department_name;
        $department->department_code = $request->department_code;

        $status = $department->save();

        if ($status) {
            return redirect()->route('department-details')->with('success', 'Department Edited Sucessfully');
        } else {
            return redirect()->route('department-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_department_details($id)
    {
        $department = Department::where('id',$id)->update(['is_active' => '0', 'is_delete' => '1']);

        return redirect()->route('department-details')->with('success', 'Department Deleted Sucessfully');
    }
}

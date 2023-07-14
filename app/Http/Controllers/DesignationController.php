<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function designation_details()
    {
        $designation = Designation::get();
        return view('setup.designation.designation-listing', compact('designation'));
    }

    public function save_designation_details(Request $request)
    {
        $validate = $request->validate([
            'designation_name' => 'required',
    
        ]);

        $status = Designation::insert([
            'designation_name' => $request->designation_name,
        
        ]);

        if ($status) {
            return back()->with('success', "Designation Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_designation_details($id, Request $request)
    {
        $designation = Designation::get();
        $editDesignation = Designation::find($id);
        return view('setup.designation.designation-edit', compact('designation', 'editDesignation'));
    }

    public function update_designation_details(Request $request)
    {
        $validate = $request->validate([
            'designation_name' => 'required',
 
        ]);

        $designation = Designation::find($request->id);
        $designation->designation_name = $request->designation_name;

        $status = $designation->save();

        if ($status) {
            return redirect()->route('designation-details')->with('success', 'Designation Edited Sucessfully');
        } else {
            return redirect()->route('designation-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_designation_details($id)
    {
        $designation = Designation::where('id',$id)->delete();

        return redirect()->route('designation-details')->with('success', 'Designation Deleted Sucessfully');
    }
}

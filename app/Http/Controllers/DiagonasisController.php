<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Diagonasis;

class DiagonasisController extends Controller
{
    public function diagonasis_details()
    {
        $diagonasis = Diagonasis::all(); 
        $department = Department::where('is_active','=',1)->get();

        return view('setup.diagonasis.diagonasis-listing', compact('diagonasis','department'));
    }

    public function save_diagonasis_details(Request $request)
    {
        $validate = $request->validate([
            'diagonasis_name' => 'required',
            'department' => 'required',
            'icd_code' => 'required',
        ]);

        $status = Diagonasis::insert([
            'diagonasis_name' => $request->diagonasis_name,
            'department' => $request->department,
            'icd_code' => $request->icd_code,
           
        ]);

        if ($status) {
            return back()->with('success', "Diagonasis Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_diagonasis_details($id, Request $request)
    {
        $diagonasis = Diagonasis::all();
        $editDiagonasis = Diagonasis::find($id);
        $department = Department::where('is_active','=',1)->get();
        return view('setup.diagonasis.edit-diagonasis', compact('diagonasis', 'editDiagonasis','department'));
    }

    public function update_diagonasis_details(Request $request)
    {
        $validate = $request->validate([
            'diagonasis_name' => 'required',
            'department' => 'required',
            'icd_code' => 'required',
        ]);

        $diagonasis = Diagonasis::find($request->id);
        $diagonasis->diagonasis_name = $request->diagonasis_name;
        $diagonasis->department      = $request->department;
        $diagonasis->icd_code        = $request->icd_code;
      
        $status = $diagonasis->save();

        if ($status) {
            return redirect()->route('diagonasis-details')->with('success', 'Diagonasis Updated Sucessfully');
        } else {
            return redirect()->route('diagonasis-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_diagonasis_details($id)
    {
        Diagonasis::where('id',$id)->delete();

        return redirect()->route('diagonasis-details')->with('success', 'Diagonasis Deleted Sucessfully');
    }
}

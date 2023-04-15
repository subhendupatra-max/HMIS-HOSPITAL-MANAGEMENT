<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TpaManagement;

class TpaManagemnetController extends Controller
{
    public function tpa_management_details()
    {
        $management = TpaManagement::all();

        return view('setup.tpa-management.tpa-management', compact('management'));
    }

    public function save_tpa_management_details(Request $request)
    {
        $request->validate([
            'TPA_name'              => 'required',
            'contact_person_name'   => 'required',
            'contact_person_ph_no'  => 'required',
        ]);

        $status = TpaManagement::Insert([
            'TPA_name'              => $request->TPA_name,
            'contact_person_name'   => $request->contact_person_name,
            'contact_person_ph_no'  => $request->contact_person_ph_no,
        ]);

        if ($status) {
            return back()->with('success', "Tpa Management Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_tpa_management_details($id)
    {
        $management = TpaManagement::all();
        $editTpaManagement = TpaManagement::where('id', $id)->first();

        return view('setup.tpa-management.edit-tpa-management', compact('management', 'editTpaManagement'));
    }

    public function update_tpa_management_details(Request $request)
    {
        $request->validate([
            'TPA_name'              => 'required',
            'contact_person_name'   => 'required',
            'contact_person_ph_no'  => 'required',
        ]);

        $management = TpaManagement::find($request->id);
        $management->TPA_name = $request->TPA_name;
        $management->contact_person_name = $request->contact_person_name;
        $management->contact_person_ph_no = $request->contact_person_ph_no;

        $status = $management->save();

        if ($status) {
            return redirect()->route('tpa-management-details')->with('success', "Tpa Management Updated Successfully");
        } else {
            return redirect()->route('tpa-management-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_tpa_management_details($id)
    {
        TpaManagement::find($id)->delete();

        return back()->with('success', "Tpa Management Deleted Successfully");
    }
}

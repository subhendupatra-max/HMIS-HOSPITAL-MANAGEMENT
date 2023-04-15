<?php

namespace App\Http\Controllers\front_office;

use App\Http\Controllers\Controller;
use App\Models\front_office\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    public function add_purpose_details()
    {
        $purpose = Purpose::all();
        return view('setup.front-office.purpose.all-purpose-listing',compact('purpose'));
    }

    public function save_purpose_front_office(Request $request)
    {
        $request->validate([
            'purpose' => 'required',
        ]);

        $purpose = new Purpose();
        $purpose->purpose = $request->purpose;
        $purpose->description = $request->description;
        $status = $purpose->save();

        if ($status) {
            return back()->with('success', " Purpose Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_purpose_in_front_office($id)
    {
        $id = base64_decode($id);
        $purpose = Purpose::all();
        $editPurpose = Purpose::where('id', $id)->first();

        return view('setup.front-office.purpose.edit-purpose-listing', compact('purpose', 'editPurpose'));
    }

    public function update_purpose_front_office(Request $request)
    {
        $request->validate([
            'purpose' => 'required',
        ]);

        $purpose = Purpose::where('id', $request->id)->first();
        $purpose->purpose = $request->purpose;
        $purpose->description = $request->description;
        $status = $purpose->save();

        if ($status) {
            return redirect()->route('add-purpose-in-front-office')->with('success', " Purpose Updated Successfully");
        } else {
            return redirect()->route('add-purpose-in-front-office')->with('error', "Something Went Wrong");
        }
    }

    public function delete_purpose_in_front_office($id)
    {
        $id = base64_decode($id);
        Purpose::find($id)->delete();

        return back()->with('success', "Purpose Deleted Successfully");
    }

}

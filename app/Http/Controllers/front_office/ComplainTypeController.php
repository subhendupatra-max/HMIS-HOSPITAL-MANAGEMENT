<?php

namespace App\Http\Controllers\front_office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\front_office\ComplainType;

class ComplainTypeController extends Controller
{
    public function add_complain_type_details()
    {
        $complainType = ComplainType::all();
        return view('setup.front-office.complain-type.add-complain-type', compact('complainType'));
    }

    public function save_complain_type_front_office(Request $request)
    {
        $request->validate([
            'complain_type' => 'required',
        ]);

        $complainType = new ComplainType();
        $complainType->complain_type = $request->complain_type;
        $complainType->description = $request->description;
        $status = $complainType->save();

        if ($status) {
            return back()->with('success', " Complain Type Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_complain_type_in_front_office($id)
    {
        $id = base64_decode($id);
        $complainType = ComplainType::all();
        $editComplainType = ComplainType::where('id', $id)->first();

        return view('setup.front-office.complain-type.edit-complain-type', compact('complainType', 'editComplainType'));
    }

    public function update_complain_type_front_office(Request $request)
    {
        $request->validate([
            'complain_type' => 'required',
        ]);

        $complain_type = ComplainType::where('id', $request->id)->first();
        $complain_type->complain_type = $request->complain_type;
        $complain_type->description = $request->description;
        $status = $complain_type->save();

        if ($status) {
            return redirect()->route('add-complain-type-in-front-office')->with('success', " Complain Type Updated Successfully");
        } else {
            return redirect()->route('add-complain-type-in-front-office')->with('error', "Something Went Wrong");
        }
    }

    public function delete_complain_type_in_front_office($id)
    {
        $id = base64_decode($id);
        ComplainType::where('id', $id)->first()->delete();

        return back()->with('success', "Complain Type Deleted Successfully");
    }
}

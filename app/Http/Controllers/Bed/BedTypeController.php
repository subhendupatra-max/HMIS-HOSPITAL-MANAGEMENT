<?php

namespace App\Http\Controllers\Bed;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\BedType;
use Illuminate\Http\Request;

class BedTypeController extends Controller
{

    public function bedType_details()
    {
        $bedType = BedType::where('is_active','=',1)->get();
        return view('setup.bedtype.bedtype-listing',compact('bedType'));
    }

    public function save_bed_type_details(Request $request)
    {
        $validate = $request->validate([
            'bedType_name' => 'required',
        ]);

        $status = BedType::insert([
            'bedType_name' => $request->bedType_name,
        ]);

        if ($status) {
            return back()->with('success', "Bed Type Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_bed_type_details($id, Request $request)
    {
        $bedType = BedType::where('is_active','=',1)->get();
        $editBedType = BedType::find($id);
        return view('setup.bedtype.bedtype-edit', compact('bedType', 'editBedType'));
    }

    public function update_bed_type_details(Request $request)
    {
        $validate = $request->validate([
            'bedType_name' => 'required',
        ]);

        $bedType = BedType::find($request->id);
        $bedType->bedType_name = $request->bedType_name;

        $status = $bedType->save();

        if ($status) {
            return redirect()->route('bed-type-details')->with('success', 'Bed Type Edited Sucessfully');
        } else {
            return redirect()->route('bed-type-details')->with('error', "Something Went Wrong");
        }
    }


    public function delete_bed_type_details($id)
    {
        $bedType = BedType::where('id',$id)->update(['is_active' => '0', 'is_delete' => '1']);

        return redirect()->route('bed-type-details')->with('success', 'Bed Type Deleted Sucessfully');
    }
}

